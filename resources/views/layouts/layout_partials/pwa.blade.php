<!-- PWA -->
<link rel="manifest" href="{{ asset('manifest.json') }}">
<script>
    if ("serviceWorker" in navigator) {
        navigator.serviceWorker.register("/sw.js")
            .then((reg) => console.log("Service Worker registered!", reg))
            .catch((err) => console.log("Service Worker failed!", err));

        navigator.serviceWorker.register("/firebase-messaging-sw.js")
            .then(registration => {
                console.log("✅ Service Worker Firebase terdaftar:", registration);
            })
            .catch(err => console.log("❌ Service Worker Firebase gagal daftar:", err));
    }
</script>
