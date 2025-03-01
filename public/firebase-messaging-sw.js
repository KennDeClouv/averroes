importScripts("https://www.gstatic.com/firebasejs/9.6.1/firebase-app-compat.js");
importScripts("https://www.gstatic.com/firebasejs/9.6.1/firebase-messaging-compat.js");

firebase.initializeApp({
    apiKey: "AIzaSyBYcKWyRIWtLPeAZOzl0YP37kSw6pMIls0",
    authDomain: "averroes-jaya.firebaseapp.com",
    projectId: "averroes-jaya",
    storageBucket: "averroes-jaya.firebasestorage.app",
    messagingSenderId: "1055114242744",
    appId: "1:1055114242744:web:5ba4c455b4c72438ca624d",
    measurementId: "G-57LTLGX570"
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage((payload) => {
    console.log("📩 Push Notif Diterima (Background):", payload);
    self.registration.showNotification(payload.notification.title, {
        body: payload.notification.body,
        icon: "/192.png"
    });
});
