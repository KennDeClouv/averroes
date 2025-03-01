self.addEventListener("install", (event) => {
    event.waitUntil(
        caches.open("averroes-cache").then((cache) => {
            const urlsToCache = [
                "/login",
                "/assets/css/demo.css",
                "/assets/js/app.js",
                "/192.png",
                "/512.png",
                "/assets/vendor/css/rtl/core.css",
                "/assets/vendor/css/rtl/theme-default.css",
                "/assets/vendor/libs/select2/select2.css",
                "/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css",
                "/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css",
                "/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css",
                "/assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css",
                "/assets/vendor/libs/spinner/spinner.css",
                "/assets/vendor/libs/toastr/toastr.css",
                "/assets/vendor/libs/apex-charts/apex-charts.css",
                "/assets/vendor/libs/flatpickr/flatpickr.css",
                "/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css",
                "/assets/js/main.js",
            ];

            return Promise.all(
                urlsToCache.map((url) =>
                    fetch(url).then((response) => {
                        if (!response.ok) {
                            throw new TypeError(`Request failed for ${url}`);
                        }
                        return cache.put(url, response);
                    })
                )
            );
        })
    );
});

self.addEventListener("fetch", (event) => {
    const url = new URL(event.request.url);

    if (url.pathname === "/") {
        event.respondWith(Response.redirect("/login", 302));
    } else if (
        url.pathname === "/login" ||
        url.pathname === "/sanctum/csrf-cookie"
    ) {
        // Selalu ambil fresh data untuk halaman login & csrf token
        event.respondWith(fetch(event.request));
    } else {
        event.respondWith(
            caches.match(event.request).then((response) => {
                return response || fetch(event.request);
            })
        );
    }
});

self.addEventListener("push", (event) => {
    notification = event.data.json();
    event.waitUntil(
        self.registration.showNotification(notification.title, {
            body: notification.body,
            icon: "/192.png",
            data: {
                notifURL: notification.url,
            },
        })
    );
});

self.addEventListener("notificationclick", (event) => {
    event.waitUntil(clients.openWindow(event.notification.data.notifURL));
});