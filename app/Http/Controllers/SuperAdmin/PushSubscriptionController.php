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
        $title = $request->input('title');
        $body = $request->input('body');
        $url = $request->input('url');

        sendNotification($title, $body, $url, $sub);

        return back()->with('success', 'Notifikasi berhasil dikirim!😋');
    }

    public function sendNotificationToAll(Request $request)
    {
        $title = $request->input('title');
        $body = $request->input('body');
        $url = $request->input('url');

        $pushSubscriptions = PushSubscription::all();

        foreach ($pushSubscriptions as $sub) {
            sendNotification($title, $body, $url, $sub);
        }

        return back()->with('success', 'Notifikasi berhasil dikirim!😋');
    }
}
