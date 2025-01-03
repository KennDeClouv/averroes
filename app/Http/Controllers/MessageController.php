<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Student;
use App\Models\StudentParent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        // $messages = Message::all();
        $user = Auth::user()->id;
        $students = Student::whereHas('User', function ($q) use ($user) {
            $q->where('id', '!=', $user);
        })->get();
        $parents = StudentParent::whereHas('User', function ($q) use ($user) {
            $q->where('id', '!=', $user);
        })->get();
        $admins = User::where('role_id', '2')->where('id', '!=', $user)->get();
        return view('chat.index', compact('students','parents','admins'));
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:500',
            'recipient_id' => 'required|exists:users,id',
        ]);

        $message = Message::create([
            'user_id' => Auth::user()->id,
            'recipient_id' => $validated['recipient_id'],
            'message' => $validated['message'],
        ]);

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }

    public function history($recipientId)
    {
        $userId = Auth::user()->id; // id user yang sedang login
        $chats = Message::where(function ($query) use ($userId, $recipientId) {
                $query->where('user_id', $userId)
                    ->where('recipient_id', $recipientId);
            })
            ->orWhere(function ($query) use ($userId, $recipientId) {
                $query->where('user_id', $recipientId)
                    ->where('recipient_id', $userId);
            })
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($chat) {
                return [
                    'message' => $chat->message,
                    'time' => formatDate($chat->created_at,'h:i A'),
                    'senderId' => $chat->user_id, // pengirim
                    'recipientId' => $chat->recipient_id,
                    'read' => $chat->read,
                ];
            });
        return response()->json($chats);
    }
    public function contacts(){
        $user = Auth::user()->id;
        $contacts = User::where('id','!=',$user)->get()
        ->map(function ($contact) {
            return [
                'id'=>$contact->id,
                'status'=>$contact->status,
                'photo'=>$contact->photo,
                'name'=>$contact->name,
                'lastSeen' => $contact->updated_at ? $contact->updated_at->diffForHumans() : 'Never',
                'bio'=>$contact->bio ?? '...',
            ];
        });
        return response()->json($contacts);
    }
    public function read(Request $request) {
        $validated = $request->validate([
            'recipient_id' => 'required|exists:users,id',
        ]);

        $userId = Auth::user()->id;
        Message::where('recipient_id', $userId)
            ->where('user_id', $validated['recipient_id']) // pengirim pesan
            ->update(['read' => true]);

        return response()->json(['success' => true]);
    }

    public function setStatus(User $user, Request $request) {
        $validated = $request->validate([
            'status'=>'required|in:online,offline,away,busy'
        ]);
        $user->update(['status' => $validated['status']]);
        return response()->json(['success' => true]);
    }
}
