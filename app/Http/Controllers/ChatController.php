<?php

namespace App\Http\Controllers;

use App\Events\MessageRead;
use App\Models\Message;
use App\Models\Student;
use App\Models\StudentParent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
use App\Events\UserStatusUpdated;

class ChatController extends Controller
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
        return view('common.chat.index', compact('students', 'parents', 'admins'));
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

        broadcast(new MessageSent($message))->toOthers();

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
                    'time' => formatDate($chat->created_at, 'h:i A'),
                    'senderId' => $chat->user_id, // pengirim
                    'recipientId' => $chat->recipient_id,
                    'read' => $chat->read,
                    'createdAt' => formatDate($chat->created_at),
                ];
            });
        return response()->json($chats);
    }
    public function contacts()
    {
        $user = Auth::user();
        $userId = $user->id;

        // inisialisasi collection kosong
        $contacts = collect();

        // jika role bukan administration_admin atau super_admin
        if (!in_array($user->Role->code, ['administration_admin', 'super_admin'])) {
            // ambil kontak berdasarkan message
            $messageContacts = Message::where(function ($query) use ($userId) {
                $query->where('user_id', $userId)
                    ->orWhere('recipient_id', $userId);
            })
                ->with(['Recipient.Role', 'User.Role', 'Recipient.Student', 'User.Student']) // eager loading untuk relasi
                ->get()
                ->map(function ($message) use ($userId) {
                    $contact = $message->user_id === $userId ? $message->Recipient : $message->User;

                    if ($contact) {
                        // hitung jumlah pesan yang belum dibaca untuk kontak ini
                        $notifCount = Message::where('user_id', $contact->id)
                            ->where('recipient_id', $userId)
                            ->where('read', false)
                            ->count();

                        return [
                            'id' => $contact->id ?? null,
                            'status' => $contact->status ?? 'unknown',
                            'photo' => $contact->photo ?? 'default.png',
                            'name' => $contact->name ?? 'unknown',
                            'lastSeen' => isset($contact->updated_at) && $contact->updated_at == $contact->created_at
                                ? 'never'
                                : ($contact->updated_at->diffForHumans() ?? 'unknown'),
                            'role' => ($contact->Role->code === 'student' && $contact->Student)
                                ? 'Santri ' . ($contact->Student->major ?? 'unknown')
                                : ($contact->Role->name ?? 'unknown'),
                            'notifCount' => $notifCount,
                        ];
                    }

                    return null;
                })
                ->filter() // hapus nilai null
                ->unique('id') // hapus duplikat berdasarkan id
                ->values();

            // ambil kontak berdasarkan role yang sama
            $sameRoleContacts = User::where('id', '!=', $userId)
                ->whereHas('Role', function ($query) use ($user) {
                    $query->where('code', $user->Role->code);
                })
                ->with(['Role', 'Student']) // eager loading untuk relasi
                ->get()
                ->map(function ($contact) use ($userId) {
                    // hitung jumlah pesan yang belum dibaca untuk kontak ini
                    $notifCount = Message::where('user_id', $contact->id)
                        ->where('recipient_id', $userId)
                        ->where('read', false)
                        ->count();

                    return [
                        'id' => $contact->id ?? null,
                        'status' => $contact->status ?? 'unknown',
                        'photo' => $contact->photo ?? 'default.png',
                        'name' => $contact->name ?? 'unknown',
                        'lastSeen' => isset($contact->updated_at) && $contact->updated_at == $contact->created_at
                            ? 'never'
                            : ($contact->updated_at->diffForHumans() ?? 'unknown'),
                        'role' => ($contact->Role->code === 'student' && $contact->Student)
                            ? 'Santri ' . ($contact->Student->major ?? 'unknown')
                            : ($contact->Role->name ?? 'unknown'),
                        'notifCount' => $notifCount,
                    ];
                });

            // gabungkan kontak dari message dan role
            $contacts = $messageContacts->merge($sameRoleContacts)
                ->unique('id') // pastikan tidak ada duplikat
                ->values();
        } else {
            // jika role administration_admin atau super_admin, ambil semua kontak
            $contacts = User::where('id', '!=', $userId)
                ->with(['Role', 'Student']) // eager loading untuk relasi
                ->get()
                ->map(function ($contact) use ($userId) {
                    // hitung jumlah pesan yang belum dibaca untuk kontak ini
                    $notifCount = Message::where('user_id', $contact->id)
                        ->where('recipient_id', $userId)
                        ->where('read', false)
                        ->count();

                    return [
                        'id' => $contact->id ?? null,
                        'status' => $contact->status ?? 'unknown',
                        'photo' => $contact->photo ?? 'default.png',
                        'name' => $contact->name ?? 'unknown',
                        'lastSeen' => isset($contact->updated_at) && $contact->updated_at == $contact->created_at
                            ? 'never'
                            : ($contact->updated_at->diffForHumans() ?? 'unknown'),
                        'role' => ($contact->Role->code === 'student' && $contact->Student)
                            ? 'Santri ' . ($contact->Student->major ?? 'unknown')
                            : ($contact->Role->name ?? 'unknown'),
                        'notifCount' => $notifCount,
                    ];
                });
        }

        return response()->json($contacts);
    }

    public function read(Request $request)
    {
        $validated = $request->validate([
            'recipient_id' => 'required|exists:users,id',
        ]);
    
        $userId = Auth::user()->id;
    
        Message::where('recipient_id', $userId)
            ->where('user_id', $validated['recipient_id'])
            ->update(['read' => true]);
    
        broadcast(new MessageRead($validated['recipient_id']))->toOthers();
    
        return response()->json(['success' => true]);
    }
    

    public function setStatus(User $user, Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|in:online,offline,away,busy'
        ]);
    
        $user->update(['status' => $validated['status']]);
    
        broadcast(new UserStatusUpdated($user))->toOthers();
    
        return response()->json(['success' => true]);
    }
    

    public function editUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'bio' => 'nullable|string|max:120',
            'status' => 'nullable|in:online,offline,away,busy',
        ]);

        $user->update($validated);
        return redirect()->route('chat.index')->with('success', 'Berhasil update profile.');
    }
}
