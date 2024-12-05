<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Room;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();
        return view('admin.teacher.index', compact('teachers'));
    }

    public function show(Teacher $teacher)
    {
        return view('admin.teacher.show', compact('teacher'));
    }

    public function create()
    {
        $classes = Classes::all();
        $rooms = Room::all();
        return view('admin.teacher.create', compact('classes', 'rooms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'fullname' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|min:8|confirmed',
            'ktp' => 'nullable|integer|unique:teachers',
            'phone' => 'nullable',
            'birthdate' => 'required',
            'birthplace' => 'required',
            'address' => 'nullable',
            'room_id' => 'nullable',
            'classes_id' => 'nullable',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'type' => 'required|in:Pengajar,Musrif,Mudzir',
            'secondary_type' => 'nullable|in:Pengajar,Musrif,Mudzir',
        ], [
            'name.required' => 'Nama ustadz wajib diisi',
            'fullname.required' => 'Nama lengkap ustadz wajib diisi',
            'email.required' => 'Email ustadz wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'username.required' => 'Username ustadz wajib diisi',
            'username.unique' => 'Username sudah terdaftar',
            'password.required' => 'Password ustadz wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'ktp.required' => 'KTP wajib diisi',
            'ktp.unique' => 'KTP sudah terdaftar',
            'gender.required' => 'Jenis kelamin ustadz wajib diisi',
            'gender.in' => 'Jenis kelamin tidak valid',
            'phone.nullable' => 'Nomor telepon ustadz boleh kosong',
            'address.nullable' => 'Alamat ustadz boleh kosong',
            'room_id.nullable' => 'Kamar ustadz boleh kosong',
            'classes_id.nullable' => 'Kelas ustadz boleh kosong',
            'birthdate.required' => 'Tanggal lahir ustadz wajib diisi',
            'birthplace.required' => 'Tempat lahir ustadz wajib diisi',
            'type.required' => 'Tipe ustadz wajib diisi',
            'type.in' => 'Tipe ustadz tidak valid',
            'secondary_type.in' => 'Tipe ustadz tidak valid',
        ]);
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'password' => $validated['password'],
            'role_id' => 3,
            'is_active' => true,
        ]);
        Teacher::create([
            'name' => $validated['fullname'],
            'ktp' => $validated['ktp'],
            'user_id' => $user->id,
            'room_id' => $validated['room_id'] ?? null,
            'classes_id' => $validated['classes_id'] ?? null,
            'gender' => $validated['gender'],
            'phone' => $validated['phone'] ?? null,
            'birthdate' => $validated['birthdate'],
            'birthplace' => $validated['birthplace'],
            'address' => $validated['address'] ?? null,
            'type' => $validated['type'],
            'secondary_type' => $validated['secondary_type'] ?? null,
        ]);

        return redirect()->route('admin.teacher.index')->with('success', 'Data ustadz berhasil ditambahkan');
    }

    public function edit(Teacher $teacher)
    {
        $classes = Classes::all();
        $rooms = Room::all();
        return view('admin.teacher.edit', compact('teacher', 'classes', 'rooms'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name' => 'required',
            'fullname' => 'required',
            'email' => 'required|email|unique:users,email,' . $teacher->user_id,
            'username' => 'required|unique:users,username,' . $teacher->user_id,
            'ktp' => 'required|integer|unique:teachers,ktp,' . $teacher->id,
            'phone' => 'nullable',
            'birthdate' => 'required',
            'birthplace' => 'required',
            'address' => 'nullable',
            'room_id' => 'nullable',
            'classes_id' => 'nullable',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'type' => 'required|in:Pengajar,Musrif,Mudzir',
            'secondary_type' => 'nullable|in:Pengajar,Musrif,Mudzir',
        ], [
            'name.required' => 'Nama ustadz wajib diisi',
            'fullname.required' => 'Nama lengkap ustadz wajib diisi',
            'email.required' => 'Email ustadz wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'username.required' => 'Username ustadz wajib diisi',
            'username.unique' => 'Username sudah terdaftar',
            'ktp.required' => 'KTP ustadz wajib diisi',
            'ktp.unique' => 'KTP sudah terdaftar',
            'gender.required' => 'Jenis kelamin ustadz wajib diisi',
            'gender.in' => 'Jenis kelamin tidak valid',
            'phone.nullable' => 'Nomor telepon ustadz boleh kosong',
            'address.nullable' => 'Alamat ustadz boleh kosong',
            'room_id.nullable' => 'Kamar ustadz boleh kosong',
            'classes_id.nullable' => 'Kelas ustadz boleh kosong',
            'birthdate.required' => 'Tanggal lahir ustadz wajib diisi',
            'birthplace.required' => 'Tempat lahir ustadz wajib diisi',
            'type.required' => 'Tipe ustadz wajib diisi',
            'type.in' => 'Tipe ustadz tidak valid',
            'secondary_type.in' => 'Tipe ustadz tidak valid',
        ]);
        $teacher->update([
            'name' => $validated['fullname'],
            'ktp' => $validated['ktp'],
            'room_id' => $validated['room_id'] ?? null,
            'classes_id' => $validated['classes_id'] ?? null,
            'gender' => $validated['gender'],
            'phone' => $validated['phone'] ?? null,
            'birthdate' => $validated['birthdate'],
            'birthplace' => $validated['birthplace'],
            'address' => $validated['address'] ?? null,
            'type' => $validated['type'],
            'secondary_type' => $validated['secondary_type'] ?? null,
        ]);
        $teacher->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => $validated['username'],
        ]);

        return redirect()->route('admin.teacher.index')->with('success', 'Data ustadz berhasil diubah');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->User->delete();
        return redirect()->route('admin.teacher.index')->with('success', 'Data ustadz berhasil dihapus');
    }
}
