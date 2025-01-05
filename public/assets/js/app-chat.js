document.addEventListener("DOMContentLoaded", function () {
    const chatHistoryBody = document.querySelector(".chat-history-body");
    const messageForm = document.getElementById("message-form");
    const contactList = document.querySelector("#contact");

    let activeContact = null;
    let polling = null;
    let isUserAtBottom = true;
    let userManuallyScrolledUp = false;

    chatHistoryBody.addEventListener("scroll", () => {
        const threshold = 10; // toleransi kecil
        const scrollDelta =
            chatHistoryBody.scrollHeight -
            chatHistoryBody.scrollTop -
            chatHistoryBody.clientHeight;
        isUserAtBottom = scrollDelta < threshold;
        userManuallyScrolledUp = scrollDelta > threshold;
    });

    const autoScroll = () => {
        if (isUserAtBottom) {
            chatHistoryBody.scrollTop = chatHistoryBody.scrollHeight;
        }
    };

    const markMessageAsRead = async (senderId) => {
        try {
            const response = await fetch(`/chat/read`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
                body: JSON.stringify({ recipient_id: senderId }),
            });
            if (!response.ok) {
                throw new Error(
                    `Failed to mark messages as read: ${response.status}`
                );
            }
        } catch (error) {
            console.error("Error marking messages as read:", error);
        }
    };

    const escapeHtml = (str) => {
        const map = {
            "&": "&amp;",
            "<": "&lt;",
            ">": "&gt;",
            '"': "&quot;",
            "'": "&#039;",
        };
        return str.replace(/[&<>"']/g, (char) => map[char]);
    };
    const updateContacts = (contacts) => {
        contactList.innerHTML = "";
        contacts.forEach((contact) => {
            const listItem = document.createElement("li");
            listItem.dataset.id = contact.id;
            listItem.className = "chat-contact-list-item mb-1 contact";
            if (activeContact && activeContact.id === contact.id) {
                listItem.classList.add("active");
            }
            listItem.innerHTML = `
                <a class="d-flex align-items-center" data-bs-toggle="sidebar" data-target="#app-chat-contacts">
                    <div class="flex-shrink-0 avatar avatar-${contact.status}">
                        <img src="${escapeHtml(
                            contact.photo
                        )}" alt="Avatar" class="rounded-circle">
                    </div>
                    <div class="chat-contact-info flex-grow-1 ms-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="chat-contact-name text-truncate m-0 fw-normal">
                                ${escapeHtml(contact.name)}

                            </h6>
                            <small class="text-muted">
                                ${
                                    contact.status === "online"
                                        ? "online"
                                        : contact.lastSeen
                                }
                            </small>
                        </div>
                        <div class="d-flex">
                        <small class="chat-contact-status text-truncate">${escapeHtml(
                            contact.role
                        )}</small>
                        ${ contact.notifCount > 0 ? `<small class="ms-auto badge badge-center rounded-pill bg-primary text-white">${contact.notifCount}</small>` : ''}
                        </div>
                    </div>
                </a>
            `;
            contactList.appendChild(listItem);

            listItem.addEventListener("click", async () => {
                activeContact = contact;
                const allContacts = document.querySelectorAll(
                    ".chat-contact-list-item"
                );
                allContacts.forEach((contactItem) => {
                    contactItem.classList.remove("active");
                });
                listItem.classList.add("active");
                messageForm.dataset.recipientId = contact.id;
                messageForm.classList.remove("d-none");
                await loadMessages(contact.id);
                startPollingMessages();
            });
        });
    };

    const fetchContacts = async () => {
        try {
            const response = await fetch("/chat/contacts");
            if (!response.ok) throw new Error(`Error: ${response.status}`);
            return await response.json();
        } catch (err) {
            console.error("Failed to fetch contacts:", err);
            return [];
        }
    };

    const loadContacts = async () => {
        const contacts = await fetchContacts();
        updateContacts(contacts);
    };

    const fetchMessages = async (recipientId) => {
        try {
            const response = await fetch(`/chat/history/${recipientId}`);
            if (!response.ok) throw new Error(`Error: ${response.status}`);
            return await response.json();
        } catch (err) {
            console.error("Failed to fetch messages:", err);
            return [];
        }
    };

    const loadMessages = async (recipientId) => {
        const messages = await fetchMessages(recipientId);
        const chatHistory = document.getElementById("chat-history");

        chatHistory.innerHTML = "";
        if (messages.length === 0) {
            chatHistory.innerHTML =
                "<li class='no-messages'>Tidak ada pesan.</li>";
            return;
        }

        let lastMessageDate = null; // untuk melacak tanggal pesan sebelumnya

        messages.forEach((msg) => {
            const currentDate = msg.createdAt; // format tanggal pesan

            // tambahkan elemen tanggal jika berbeda dari tanggal sebelumnya
            if (lastMessageDate !== currentDate) {
                const dateElement = document.createElement("li");
                dateElement.className = "chat-date-separator";
                dateElement.innerHTML = `
                    <div class="date-wrapper text-center">
                        <span class="date-label">${currentDate}</span>
                    </div>
                `;
                chatHistory.appendChild(dateElement);
                lastMessageDate = currentDate; // perbarui tanggal terakhir
            }

            const messageElement = document.createElement("li");
            messageElement.className = [
                "chat-message",
                msg.read ? "read" : "unread",
                msg.senderId === window.userId
                    ? "chat-message-right text-end ms-auto"
                    : "text-start",
            ].join(" ");

            messageElement.innerHTML = `
                <div class="d-flex overflow-hidden">
                    <div class="chat-message-wrapper flex-grow-1">
                        <div class="chat-message-text d-flex gap-2 align-items-end">
                            <p class="mb-0 auto-wrap">${escapeHtml(
                                msg.message
                            )}</p>
                            ${
                                msg.senderId === window.userId
                                    ? `<i class="fa-solid fa-check ${
                                          msg.read ? "text-success" : ""
                                      }"></i>`
                                    : ""
                            }
                        </div>
                    </div>
                </div>
            `;

            // tandai pesan sebagai telah dibaca jika kondisi terpenuhi
            if (
                msg.senderId !== window.userId &&
                msg.recipientId === window.userId &&
                !msg.read
            ) {
                markMessageAsRead(msg.senderId);
            }

            chatHistory.appendChild(messageElement);
        });

        autoScroll();
    };

    const startPollingMessages = () => {
        stopPollingMessages(); // pastikan polling lama dihentikan

        if (activeContact) {
            polling = setInterval(() => {
                loadMessages(activeContact.id);
            }, 5000);
        }
    };

    const stopPollingMessages = () => {
        if (polling) {
            clearInterval(polling);
            polling = null;
        }
    };

    messageForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        const messageInput = messageForm.querySelector(".message-input");
        const recipientId = messageForm.dataset.recipientId;
        const message = messageInput.value.trim();

        if (!message) {
            alert("Pesan tidak boleh kosong!");
            return;
        }

        try {
            const response = await fetch("/chat/send", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
                body: JSON.stringify({ recipient_id: recipientId, message }),
            });

            if (!response.ok) throw new Error("Gagal mengirim pesan.");
            const { message_id } = await response.json();

            const newMessage = document.createElement("li");
            newMessage.className =
                "chat-message chat-message-right text-end ms-auto";
            newMessage.dataset.id = message_id;
            newMessage.innerHTML = `
                <div class="d-flex overflow-hidden">
                    <div class="chat-message-wrapper flex-grow-1">
                        <div class="chat-message-text d-flex gap-2 align-items-end">
                            <p class="mb-0">${escapeHtml(message)}</p>
                            <i class="fa-solid fa-check"></i>
                        </div>
                    </div>
                </div>
            `;
            document.getElementById("chat-history").appendChild(newMessage);
            messageInput.value = "";
            autoScroll();
        } catch (err) {
            console.error("Failed to send message:", err);
            alert("Terjadi kesalahan saat mengirim pesan.");
        }
        autoScroll();
    });

    let intervalId;

    function checkAndLoadContacts() {
        if (!document.querySelector(".chat-search-input").matches(":focus")) {
            loadContacts();
            intervalId = setTimeout(checkAndLoadContacts, 5000);
        } else if (intervalId) {
            clearTimeout(intervalId); // hentikan timeout jika input fokus
            intervalId = null;
        }
    }

    // panggil fungsi pertama kali untuk memulai
    checkAndLoadContacts();

    let e = document.querySelector(".app-chat-contacts .sidebar-body"),
        t = [].slice.call(
            document.querySelectorAll(
                ".chat-contact-list-item:not(.chat-contact-list-item-title)"
            )
        ),
        a = document.querySelector(".chat-history-body"),
        c = document.querySelector(".app-chat-sidebar-left .sidebar-body"),
        r = document.querySelector(".app-chat-sidebar-right .sidebar-body"),
        l = [].slice.call(
            document.querySelectorAll(
                ".form-check-input[name='status']"
            )
        ),
        s = $(".chat-sidebar-left-user-about"),
        // o = document.querySelector(".form-send-message"),
        n = document.querySelector(".message-input"),
        i = document.querySelector(".chat-search-input"),
        d = $(".speech-to-text"),
        u = {
            active: "avatar-online",
            offline: "avatar-offline",
            away: "avatar-away",
            busy: "avatar-busy",
        };
    function p() {
        a.scrollTo(0, a.scrollHeight);
    }
    function v(e, a, c, t) {
        e.forEach((e) => {
            var t = e.textContent.toLowerCase();
            !c || -1 < t.indexOf(c)
                ? (e.classList.add("d-flex"), e.classList.remove("d-none"), a++)
                : e.classList.add("d-none");
        }),
            0 == a ? t.classList.remove("d-none") : t.classList.add("d-none");
    }
    e &&
        new PerfectScrollbar(e, {
            wheelPropagation: !1,
            suppressScrollX: !0,
        }),
        a &&
            new PerfectScrollbar(a, {
                wheelPropagation: !1,
                suppressScrollX: !0,
            }),
        c &&
            new PerfectScrollbar(c, {
                wheelPropagation: !1,
                suppressScrollX: !0,
            }),
        r &&
            new PerfectScrollbar(r, {
                wheelPropagation: !1,
                suppressScrollX: !0,
            }),
        p(),
        s.length &&
            s.maxlength({
                alwaysShow: !0,
                warningClass: "label label-success bg-success text-white",
                limitReachedClass: "label label-danger",
                separator: "/",
                validate: !0,
                threshold: 120,
            }),
        l.forEach((e) => {
            e.addEventListener("click", (e) => {
                const a = u[e.currentTarget.value];
                document.querySelector(".chat-sidebar-left-user .avatar").className = `avatar avatar-xl chat-sidebar-avatar ${a}`;
                document.querySelector(".app-chat-contacts .avatar").className = `flex-shrink-0 avatar ${a} me-3`;
                document.querySelectorAll("#avatar-status").forEach(se => se.className = `avatar ${a}`);
            });
        }),
        t.forEach((e) => {
            e.addEventListener("click", (e) => {
                t.forEach((e) => {
                    e.classList.remove("active");
                }),
                    e.currentTarget.classList.add("active");
            });
        }),
        i &&
            i.addEventListener("keyup", (e) => {
                var e = e.currentTarget.value.toLowerCase(),
                    t = document.querySelector(".chat-list-item-0"),
                    a = document.querySelector(".contact-list-item-0"),
                    c = [].slice.call(
                        document.querySelectorAll(
                            "#chat-list li:not(.chat-contact-list-item-title)"
                        )
                    ),
                    r = [].slice.call(
                        document.querySelectorAll(
                            "#contact-list li:not(.chat-contact-list-item-title)"
                        )
                    );
                v(c, 0, e, t), v(r, 0, e, a);
            });
    var b, f, y;
    d.length &&
        null != (b = b || webkitSpeechRecognition) &&
        ((f = new b()),
        (y = !1),
        d.on("click", function () {
            let t = $(this);
            !(f.onspeechstart = function () {
                y = !0;
            }) === y && f.start(),
                (f.onerror = function (e) {
                    y = !1;
                }),
                (f.onresult = function (e) {
                    t.closest(".form-send-message")
                        .find(".message-input")

                        .val(e.results[0][0].transcript);
                }),
                (f.onspeechend = function (e) {
                    (y = !1), f.stop();
                });
        }));
});
