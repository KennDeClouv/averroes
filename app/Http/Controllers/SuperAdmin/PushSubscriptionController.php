<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PushSubscription;
use Minishlink\WebPush\WebPush;

class PushSubscriptionController extends Controller
{
    public function index()
    {
        $pushSubscriptions = PushSubscription::all();
        return view('roles.SuperAdmin.notification.index', compact('pushSubscriptions'));
    }

    public function sendNotification(Request $request, PushSubscription $sub)
    {
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

        $result = $webPush->sendOneNotification(
            $subscription,
            json_encode($request->input())
        );

        return response()->json($result);
    }

    public function sendNotificationToAll(Request $request)
    {
        $webPush = new WebPush([
            'VAPID' => [
                'publicKey' => env('VAPID_PUBLIC_KEY'),
                'privateKey' => env('VAPID_PRIVATE_KEY'),
                'subject' => env('APP_URL'),
            ],
        ]);

        $pushSubscriptions = PushSubscription::all();

        foreach ($pushSubscriptions as $sub) {
            // Convert PushSubscription to Minishlink\WebPush\Subscription
            $subscriptionData = json_decode($sub->data, true);
            $subscription = new \Minishlink\WebPush\Subscription(
                $subscriptionData['endpoint'],
                $subscriptionData['keys']['p256dh'],
                $subscriptionData['keys']['auth']
            );

            $result = $webPush->sendOneNotification(
                $subscription,
                json_encode($request->input())
            );
        }

        return response()->json(['message' => 'Notifications sent to all subscribers.']);
    }
}
