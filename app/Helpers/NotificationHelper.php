<?php

use Minishlink\WebPush\WebPush;
use App\Models\PushSubscription;

if (!function_exists('sendNotification')) {
    function sendNotification($title, $body, $url, PushSubscription $sub)
    {
        $name = $sub->user->name ?? 'kamu';
        $title = str_replace('NAME', $name, $title);
        $body = str_replace('NAME', $name, $body);

        $webPush = new WebPush([
            'VAPID' => [
                'publicKey' => env('VAPID_PUBLIC_KEY'),
                'privateKey' => env('VAPID_PRIVATE_KEY'),
                'subject' => env('APP_URL'),
            ],
        ]);

        // Convert PushSubscription to Minishlink\WebPush\Subscription
        $subscriptionData = json_decode($sub->data, true);
        $subscription = new \Minishlink\WebPush\Subscription(
            $subscriptionData['endpoint'],
            $subscriptionData['keys']['p256dh'],
            $subscriptionData['keys']['auth']
        );

        $webPush->sendOneNotification(
            $subscription,
            json_encode(['title' => $title, 'body' => $body, 'url' => $url])
        );
    }
}

if (! function_exists('sendWhatsAppMessage')) {
    function sendWhatsAppMessage($to, $message)
    {
        $url = "https://api.ultramsg.com/" . env('ULTRAMSG_INSTANCE_ID') . "/messages/chat";

        $data = [
            'token' => env('ULTRAMSG_TOKEN'),
            'to' => $to,
            'body' => $message,
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}
if (! function_exists('sendWhatsAppImage')) {
    function sendWhatsAppImage($to, $imageUrl, $caption = null)
    {
        $url = "https://api.ultramsg.com/" . env('ULTRAMSG_INSTANCE_ID') . "/messages/image";

        $data = [
            'token' => env('ULTRAMSG_TOKEN'),
            'to' => $to,
            'image' => $imageUrl,
            'caption' => $caption,
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}
