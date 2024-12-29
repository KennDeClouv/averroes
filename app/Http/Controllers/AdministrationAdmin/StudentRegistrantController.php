<?php

namespace App\Http\Controllers\AdministrationAdmin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentRegistrant;
use App\Models\User;
use Illuminate\Http\Request;

class StudentRegistrantController extends Controller
{
    public function index()
    {
        $studentRegistrants = StudentRegistrant::all();
        return view('AdministrationAdmin.student_registrant.index', compact('studentRegistrants'));
    }
    public function user()
    {
        $studentRegistrants = User::where('role_id', '=', 5)->get();
        return view('AdministrationAdmin.student_registrant.user', compact('studentRegistrants'));
    }

    public function create()
    {
        return view('AdministrationAdmin.student_registrant.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|min:8|confirmed',
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email harus berupa email yang valid',
            'username.required' => 'Nama User harus diisi',
            'username.unique' => 'Nama User sudah ada',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirm' => 'Konfirmasi Password salah',
        ]);

        $validated['role_id'] = 5;
        $validated['is_active'] = true;
        User::create($validated);
        return redirect()->route('administrationadmin.studentregistrant.index')->with('success', 'User calon santri berhasil dibuat.');
    }

    public function show(StudentRegistrant $studentRegistrant)
    {
        return view('AdministrationAdmin.student_registrant.show', compact('studentRegistrant'));
    }

    public function edit(User $user)
    {
        return view('AdministrationAdmin.student_registrant.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|min:8|confirmed',
        ]);

        $user->update($validated);
        return redirect()->route('administrationadmin.studentregistrant.index')->with('success', 'User calon santri berhasil diubah.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('administrationadmin.studentregistrant.index')->with('success', 'User calon santri berhasil dihapus.');
    }

    public function accept(StudentRegistrant $studentRegistrant)
    {
        if (!$studentRegistrant) {
            return back()->with('error', 'Student registrant not found.');
        }

        // Update user role
        $studentRegistrant->User()->update([
            "role_id" => 5
        ]);
        $studentRegistrant->update([
            'status' => "approve"
        ]);
        Student::create($studentRegistrant->only([
            "name",
            "full_name",
            "birth_date",
            "birth_place",
            "address",
            "education_sd",
            "education_smp",
            "nisn",
            "sibling_info",
            "quran_memorization",
            "achievements",
            "school_motivation",
            "major",
            "medical_history",
            "father_name",
            "father_occupation",
            "father_income",
            "mother_name",
            "mother_occupation",
            "mother_income",
            "parent_whatsapp",
            "quran_record_link",
            "student_status",
            "attachment_family_register",
            "attachment_birth_certificate",
            "attachment_diploma",
        ]) + ["user_id" => $studentRegistrant->User->id]);

        // Prepare and send notification message
        $message = "📢 Notifikasi PPDB Averroes
---
[SANTRI DITERIMA]
Santri atas nama {$studentRegistrant->full_name} telah diterima oleh Averroes Digital Islamic School.
untuk informasi lebih lanjut silakan hubungi admin.

- Averroes Digital Islamic School -";

        sendWhatsAppMessage('6281336446666', $message);
        return redirect()->route("administrationadmin.studentregistrant.index")->with('success', 'Calon santri berhasil diterima dan diberi pesan.');
    }

    public function sendNotification()
    {
        $message = "*Notifikasi PPDB Averroes*

[SANTRI DITERIMA]

Santri atas nama Ken telah diterima oleh Averroes Digital Islamic School.
untuk informasi lebih lanjut silakan hubungi admin.

> *Averroes Digital Islamic School*";

        sendWhatsAppMessage('6281336446666', $message);
        return redirect()->route("administrationadmin.studentregistrant.index")->with('success', 'Calon santri berhasil diterima dan diberi pesan.');
    }
}
