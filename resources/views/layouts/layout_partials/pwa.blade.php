<!-- PWA -->
<link rel="manifest" href="{{ asset('manifest.json') }}">
<script>
    if ("serviceWorker" in navigator) {
        navigator.serviceWorker.register("/sw.js")
            .then((reg) => console.log("✅ Service Worker registered!", reg))
            .catch((err) => console.log("❌ Service Worker failed!", err));
    }
    Notification.requestPermission().then((permission) => {
        if (permission === "granted") {
            console.log("🔔 Izin notifikasi diberikan!");
            @if (Auth::check() && Auth::user()->PushSubscriptions->isEmpty())
                navigator.serviceWorker.ready.then((sw) => {
                    sw.pushManager.getSubscription().then((subscription) => {
                        if (!subscription) {
                            sw.pushManager.subscribe({
                                userVisibleOnly: true,
                                applicationServerKey: "{{ env('VAPID_PUBLIC_KEY') }}"
                            }).then((sub) => {
                                fetch("/api/subscribe", {
                                        method: "POST",
                                        headers: {
                                            "Content-Type": "application/json",
                                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                        },
                                        body: JSON.stringify(sub)
                                    }).then((res) => res.json())
                                    .then((data) => {
                                        console.log(
                                            "🔔 Subscribed to push notifications!"
                                        );
                                    })
                                    .catch((err) => {
                                        console.log(
                                            "❌ Failed to subscribe to push notifications!"
                                        );
                                    });
                            });
                        } else {
                            console.log("🔔 Already subscribed to push notifications!");
                        }
                    });
                });
            @endif
        } else {
            console.log("❌ Izin notifikasi ditolak!");
        }
    });
</script>
