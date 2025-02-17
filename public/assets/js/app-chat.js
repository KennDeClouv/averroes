window.Pusher = Pusher;
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: document.querySelector('meta[name="pusher-app-key"]').content,
    wsHost: window.location.hostname,
    wsPort: 6001,
    forceTLS: false, // set to true in production
    disableStats: true,
});

document.addEventListener("DOMContentLoaded", function () {
    const chatHistoryBody = document.querySelector(".chat-history-body");
    const messageForm = document.getElementById("message-form");
    const contactList = document.querySelector("#contact");
    let activeContact = null;
    let polling = null;
    let isUserAtBottom = true;
    let userManuallyScrolledUp = false;

    // Scroll Detection
    chatHistoryBody.addEventListener("scroll", () => {
        const threshold = 10;
        const scrollDelta = chatHistoryBody.scrollHeight - chatHistoryBody.scrollTop - chatHistoryBody.clientHeight;
        isUserAtBottom = scrollDelta < threshold;
        userManuallyScrolledUp = scrollDelta > threshold;
    });

    // Auto Scroll
    const autoScroll = () => {
        if (isUserAtBottom) {
            chatHistoryBody.scrollTop = chatHistoryBody.scrollHeight;
        }
    };

    // Mark Message as Read
    const markMessageAsRead = async (senderId) => {
        try {
            const response = await fetch(`/chat/read`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({ recipient_id: senderId }),
            });
            if (!response.ok) {
                throw new Error(`Failed to mark messages as read: ${response.status}`);
            }
        } catch (error) {
            console.error("Error marking messages as read:", error);
        }
    };

    // Escape HTML Special Characters
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

    // Update Contact List
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
                        <img src="${escapeHtml(contact.photo)}" alt="Avatar" class="rounded-circle">
                    </div>
                    <div class="chat-contact-info flex-grow-1 ms-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="chat-contact-name text-truncate m-0 fw-normal">
                                ${escapeHtml(contact.name)}
                            </h6>
                            <small class="text-muted">
                                ${contact.status === "online" ? "online" : contact.lastSeen}
                            </small>
                        </div>
                        <div class="d-flex">
                            <small class="chat-contact-status text-truncate">${escapeHtml(contact.role)}</small>
                            ${contact.notifCount > 0 ? `<small class="ms-auto badge badge-center rounded-pill bg-primary text-white">${contact.notifCount}</small>` : ''}
                        </div>
                    </div>
                </a>
            `;
            contactList.appendChild(listItem);
            listItem.addEventListener("click", async () => {
                activeContact = contact;
                const allContacts = document.querySelectorAll(".chat-contact-list-item");
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

    // Fetch Contacts
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

    // Fetch Messages
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
            chatHistory.innerHTML = "<li class='no-messages'>Tidak ada pesan.</li>";
            return;
        }
        let lastMessageDate = null;
        messages.forEach((msg) => {
            const currentDate = msg.createdAt;
            if (lastMessageDate !== currentDate) {
                const dateElement = document.createElement("li");
                dateElement.className = "chat-date-separator";
                dateElement.innerHTML = `
                    <div class="date-wrapper text-center">
                        <span class="date-label">${currentDate}</span>
                    </div>
                `;
                chatHistory.appendChild(dateElement);
                lastMessageDate = currentDate;
            }
            const messageElement = document.createElement("li");
            messageElement.className = [
                "chat-message",
                msg.read ? "read" : "unread",
                msg.senderId === window.userId ? "chat-message-right text-end ms-auto" : "text-start",
            ].join(" ");
            messageElement.innerHTML = `
                <div class="d-flex overflow-hidden">
                    <div class="chat-message-wrapper flex-grow-1">
                        <div class="chat-message-text d-flex gap-2 align-items-end">
                            <p class="mb-0 auto-wrap">${escapeHtml(msg.message)}</p>
                            ${msg.senderId === window.userId ? `<i class="fa-solid fa-check ${msg.read ? "text-success" : ""}"></i>` : ""}
                        </div>
                    </div>
                </div>
            `;
            if (msg.senderId !== window.userId && msg.recipientId === window.userId && !msg.read) {
                markMessageAsRead(msg.senderId);
            }
            chatHistory.appendChild(messageElement);
        });
        autoScroll();
    };

    window.Echo.channel('chat.' + activeContact.id)
    .listen('MessageSent', (event) => {
        const newMessage = event.message;
        // tambahkan message ke chat history
        const messageElement = document.createElement("li");
        messageElement.className = [
            "chat-message",
            newMessage.read ? "read" : "unread",
            newMessage.senderId === window.userId ? "chat-message-right text-end ms-auto" : "text-start",
        ].join(" ");
        messageElement.innerHTML = `
            <div class="d-flex overflow-hidden">
                <div class="chat-message-wrapper flex-grow-1">
                    <div class="chat-message-text d-flex gap-2 align-items-end">
                        <p class="mb-0">${escapeHtml(newMessage.message)}</p>
                        ${newMessage.senderId === window.userId ? `<i class="fa-solid fa-check ${newMessage.read ? "text-success" : ""}"></i>` : ""}
                    </div>
                </div>
            </div>
        `;
        document.getElementById("chat-history").appendChild(messageElement);
        autoScroll();
    });

    loadContacts();
    // Poll Messages
    // const startPollingMessages = () => {
    //     stopPollingMessages();
    //     if (activeContact) {
    //         polling = setInterval(() => {
    //             loadMessages(activeContact.id);
    //         }, 5000);
    //     }
    // };

    // const stopPollingMessages = () => {
    //     if (polling) {
    //         clearInterval(polling);
    //         polling = null;
    //     }
    // };

    // Send Message
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
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({ recipient_id: recipientId, message }),
            });
            if (!response.ok) throw new Error("Gagal mengirim pesan.");
            const { message_id } = await response.json();
            const newMessage = document.createElement("li");
            newMessage.className = "chat-message chat-message-right text-end ms-auto";
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

    // Load Contacts periodically
    let intervalId;
    function checkAndLoadContacts() {
        if (!document.querySelector(".chat-search-input").matches(":focus")) {
            loadContacts();
            intervalId = setTimeout(checkAndLoadContacts, 5000);
        } else if (intervalId) {
            clearTimeout(intervalId);
            intervalId = null;
        }
    }
    checkAndLoadContacts();

    // PerfectScrollbar initialization
    let e = document.querySelector(".chat-history-body");
    let ps = new PerfectScrollbar(e);

    // Load initial data
    loadContacts();
});
