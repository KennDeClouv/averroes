<!-- Core JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bs-stepper@1.7.0/dist/js/bs-stepper.min.js"></script>
<!-- Vendors JS -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.28.3/dist/apexcharts.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/@form-validation/bootstrap@0.8.1/dist/umd/bootstrap.min.js"></script> --}}
<!-- Main JS -->
<script src="{{ asset('assets/js/main.js') }}"></script>

@yield('page-script')
<script type="module">
    import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.1/firebase-app.js";
    import { getMessaging, getToken, onMessage } from "https://www.gstatic.com/firebasejs/9.6.1/firebase-messaging.js";

    const firebaseConfig = {
        apiKey: "AIzaSyBYcKWyRIWtLPeAZOzl0YP37kSw6pMIls0",
        authDomain: "averroes-jaya.firebaseapp.com",
        projectId: "averroes-jaya",
        storageBucket: "averroes-jaya.firebasestorage.app",
        messagingSenderId: "1055114242744",
        appId: "1:1055114242744:web:5ba4c455b4c72438ca624d",
        measurementId: "G-57LTLGX570"
    };

    const app = initializeApp(firebaseConfig);
    const messaging = getMessaging(app);

    function requestPermission() {
        Notification.requestPermission().then(permission => {
            if (permission === "granted") {
                getToken(messaging, { vapidKey: "BFtRPZoJOmU3qeWg_1KT5ELFfJ80Brj5oFyQGYfDlpWB8Uum23qFwhxrAXZYF9YTu-0P9127tnixaj81kkrbBLM" }).then((currentToken) => {
                    if (currentToken) {
                        console.log("✅ Token:", currentToken);
                    } else {
                        console.log("❌ No token available.");
                    }
                }).catch((err) => console.log("❌ Error getting token:", err));
            }
        });
    }

    onMessage(messaging, (payload) => {
        console.log("📩 Push Notif Diterima (Foreground):", payload);
    });

    requestPermission();
</script>