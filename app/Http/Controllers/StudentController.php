<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Room;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('admin.student.index', compact('students'));
    }

    public function show(Student $student)
    {
        return view('admin.student.show', compact('student'));
    }

    public function create()
    {
        $classes = Classes::all();
        $rooms = Room::all();
        return view('admin.student.create', compact('classes', 'rooms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'fullname' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|min:8|confirmed',
            'nisn' => 'required|unique:students',
            'phone' => 'nullable',
            'birthdate' => 'required',
            'birthplace' => 'required',
            'address' => 'nullable',
            'classes_id' => 'nullable',
            'room_id' => 'nullable',
            'gender' => 'required|in:Laki-laki,Perempuan',
        ], [
            'name.required' => 'Nama santri wajib diisi',
            'fullname.required' => 'Nama lengkap santri wajib diisi',
            'email.required' => 'Email santri wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'username.required' => 'Username santri wajib diisi',
            'username.unique' => 'Username sudah terdaftar',
            'password.required' => 'Password santri wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'nisn.required' => 'NISN santri wajib diisi',
            'nisn.unique' => 'NISN sudah terdaftar',
            'gender.required' => 'Jenis kelamin santri wajib diisi',
            'gender.in' => 'Jenis kelamin tidak valid',
            'phone.nullable' => 'Nomor telepon santri boleh kosong',
            'address.nullable' => 'Alamat santri boleh kosong',
            'classes_id.nullable' => 'Kelas santri boleh kosong',
            'room_id.nullable' => 'Kamar santri boleh kosong',
            'birthdate.required' => 'Tanggal lahir santri wajib diisi',
            'birthplace.required' => 'Tempat lahir santri wajib diisi',
        ]);
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'password' => $validated['password'],
            'role_id' => 3,
            'is_active' => true,
        ]);
        Student::create([
            'name' => $validated['fullname'],
            'nisn' => $validated['nisn'],
            'user_id' => $user->id,
            'classes_id' => $validated['classes_id'] ?? null,
            'room_id' => $validated['room_id'] ?? null,
            'gender' => $validated['gender'],
            'phone' => $validated['phone'] ?? null,
            'birthdate' => $validated['birthdate'],
            'birthplace' => $validated['birthplace'],
            'address' => $validated['address'] ?? null,
        ]);

        return redirect()->route('admin.student.index')->with('success', 'Data santri berhasil ditambahkan');
    }

    public function edit(Student $student)
    {
        $classes = Classes::all();
        $rooms = Room::all();
        return view('admin.student.edit', compact('student', 'classes', 'rooms'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required',
            'fullname' => 'required',
            'email' => 'required|email|unique:users,email,' . $student->user_id,
            'username' => 'required|unique:users,username,' . $student->user_id,
            'nisn' => 'required|unique:students,nisn,' . $student->id,
            'phone' => 'nullable',
            'birthdate' => 'required',
            'birthplace' => 'required',
            'address' => 'nullable',
            'classes_id' => 'nullable',
            'room_id' => 'nullable',
            'gender' => 'required|in:Laki-laki,Perempuan',
        ], [
            'name.required' => 'Nama santri wajib diisi',
            'fullname.required' => 'Nama lengkap santri wajib diisi',
            'email.required' => 'Email santri wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'username.required' => 'Username santri wajib diisi',
            'username.unique' => 'Username sudah terdaftar',
            'nisn.required' => 'NISN santri wajib diisi',
            'nisn.unique' => 'NISN sudah terdaftar',
            'gender.required' => 'Jenis kelamin santri wajib diisi',
            'gender.in' => 'Jenis kelamin tidak valid',
            'phone.nullable' => 'Nomor telepon santri boleh kosong',
            'address.nullable' => 'Alamat santri boleh kosong',
            'classes_id.nullable' => 'Kelas santri boleh kosong',
            'room_id.nullable' => 'Kamar santri boleh kosong',
            'birthdate.required' => 'Tanggal lahir santri wajib diisi',
            'birthplace.required' => 'Tempat lahir santri wajib diisi',
        ]);
        $student->update([
            'name' => $validated['fullname'],
            'nisn' => $validated['nisn'],
            'classes_id' => $validated['classes_id'] ?? null,
            'room_id' => $validated['room_id'] ?? null,
            'gender' => $validated['gender'],
            'phone' => $validated['phone'] ?? null,
            'birthdate' => $validated['birthdate'],
            'birthplace' => $validated['birthplace'],
            'address' => $validated['address'] ?? null,
        ]);
        $student->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => $validated['username'],
        ]);

        return redirect()->route('admin.student.index')->with('success', 'Data santri berhasil diubah');
    }

    public function destroy(Student $student)
    {
        $student->User->delete();
        return redirect()->route('admin.student.index')->with('success', 'Data santri berhasil dihapus');
    }
}
