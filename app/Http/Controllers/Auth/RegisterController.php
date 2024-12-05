<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreImamRequest;
use App\Models\Account;
use App\Models\Imam;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    private function uploadPhoto($photo)
    {
        // Define the logic for uploading the photo
        if ($photo && file_exists(public_path($photo))) {
            unlink(public_path($photo));
        }
        // Generate nama unik untuk file
        $filename = uniqid() . '_' . time() . '.' . $photo->getClientOriginalExtension();

        // Pindahkan file ke folder
        $photoPath = $photo->move(public_path('public/uploads/photo/'), $filename);
        return 'public/uploads/photo/' . $filename;
    }
    public function index()
    {
        return view('auth.register');
    }

    public function store(StoreImamRequest $request)
    {
        $validated = $request->validated();

        $validated['photo'] = $request->hasFile('photo')
            ? $this->uploadPhoto($request->file('photo'))
            : null;

        // Simpan user
        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'] ?? null,
            'password' => $validated['password'],
            'photo' => $validated['photo'],
            'name' => $validated['fullname'],
            'role_id' => 3,
        ]);

        // Simpan admin
        Imam::create([
            'user_id' => $user->id,
            'fullname' => $validated['fullname'],
            'phone' => $validated['phone'],
            'birthplace' => $validated['birthplace'],
            'birthdate' => $validated['birthdate'],
            'juz' => $validated['juz'],
            'school' => $validated['school'],
            'description' => $validated['description'] ?? null,
            'address' => $validated['address'] ?? null,
            'join_date' => $validated['join_date'],
            'no_rekening' => $validated['no_rekening'],
            'status' => $validated['status'],
            'child_count' => $validated['child_count'],
            'wife_count' => $validated['wife_count'],
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat.');
    }
}
