<?php

namespace App\Http\Controllers\AdministrationAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Http\Requests\UserRequest;
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
        return view('roles.AdministrationAdmin.student.index', compact('students'));
    }

    public function show(Student $student)
    {
        return view('roles.AdministrationAdmin.student.show', compact('student'));
    }

    public function create()
    {
        $classes = Classes::all();
        $rooms = Room::all();
        return view('roles.AdministrationAdmin.student.create', compact('classes', 'rooms'));
    }

    public function store(StudentRequest $studentRequest, UserRequest $userRequest)
    {
        // Validasi data dari masing-masing Request
        $validatedUser = $userRequest->validated();
        $validatedStudent = $studentRequest->validated();

        // Buat user baru
        $user = User::create(array_merge($validatedUser, [
            'role_id' => 4,
            'is_active' => true,
        ]));

        // Proses file upload jika ada
        if ($studentRequest->hasFile('attachment_family_register')) {
            $file = $studentRequest->file('attachment_family_register');
            $validatedStudent['attachment_family_register'] = uploadFile($file, 'uploads/family_registers');
        }
        if ($studentRequest->hasFile('attachment_birth_certificate')) {
            $file = $studentRequest->file('attachment_birth_certificate');
            $validatedStudent['attachment_birth_certificate'] = uploadFile($file, 'uploads/birth_certificates');
        }
        if ($studentRequest->hasFile('attachment_diploma')) {
            $file = $studentRequest->file('attachment_diploma');
            $validatedStudent['attachment_diploma'] = uploadFile($file, 'uploads/diplomas');
        }

        // Buat student baru
        Student::create(array_merge(
            $validatedStudent,
            [
                'user_id' => $user->id,
                'attachment_family_register' => $validatedStudent['attachment_family_register'] ?? null,
                'attachment_birth_certificate' => $validatedStudent['attachment_birth_certificate'] ?? null,
                'attachment_diploma' => $validatedStudent['attachment_diploma'] ?? null,
            ]
        ));

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('administrationadmin.student.index')->with('success', 'Data santri berhasil ditambahkan');
    }

    public function edit(Student $student)
    {
        $classes = Classes::all();
        $rooms = Room::all();
        return view('roles.AdministrationAdmin.student.edit', compact('student', 'classes', 'rooms'));
    }

    public function update(StudentRequest $studentRequest, UserRequest $userRequest, Student $student)
    {
        // Validasi data dari masing-masing Request
        $validatedUser = $userRequest->validated();
        $validatedStudent = $studentRequest->validated();

        // Update data user
        $student->User->update($validatedUser);

        // Proses file upload jika ada dan hapus file lama
        if ($studentRequest->hasFile('attachment_family_register')) {
            $file = $studentRequest->file('attachment_family_register');
            // Hapus file lama jika ada
            if ($student->attachment_family_register) {
                deleteFile('uploads/family_registers/' . basename($student->attachment_family_register));
            }
            $validatedStudent['attachment_family_register'] = uploadFile($file, 'uploads/family_registers');
        }

        if ($studentRequest->hasFile('attachment_birth_certificate')) {
            $file = $studentRequest->file('attachment_birth_certificate');
            // Hapus file lama jika ada
            if ($student->attachment_birth_certificate) {
                deleteFile('uploads/birth_certificates/' . basename($student->attachment_birth_certificate));
            }
            $validatedStudent['attachment_birth_certificate'] = uploadFile($file, 'uploads/birth_certificates');
        }

        if ($studentRequest->hasFile('attachment_diploma')) {
            $file = $studentRequest->file('attachment_diploma');
            // Hapus file lama jika ada
            if ($student->attachment_diploma) {
                deleteFile('uploads/diplomas/' . basename($student->attachment_diploma));
            }
            $validatedStudent['attachment_diploma'] = uploadFile($file, 'uploads/diplomas');
        }

        // Update data student
        $student->update(array_merge(
            $validatedStudent,
            [
                'attachment_family_register' => $validatedStudent['attachment_family_register'] ?? $student->attachment_family_register,
                'attachment_birth_certificate' => $validatedStudent['attachment_birth_certificate'] ?? $student->attachment_birth_certificate,
                'attachment_diploma' => $validatedStudent['attachment_diploma'] ?? $student->attachment_diploma,
            ]
        ));

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('administrationadmin.student.index')->with('success', 'Data santri berhasil diperbarui');
    }


    public function destroy(Student $student)
    {
        $student->User->delete();
        return redirect()->route('administrationadmin.student.index')->with('success', 'Data santri berhasil dihapus');
    }
}
