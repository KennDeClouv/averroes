<?php

namespace App\Http\Controllers\StudentRegistrant;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\StudentRegistrant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('StudentRegistrant.index');
    }

    public function store(StudentRequest $request)
    {
        $validated = $request->validated();

        // Proses file upload jika ada
        if ($request->hasFile('attachment_family_register')) {
            $file = $request->file('attachment_family_register');
            $validated['attachment_family_register'] = uploadFile($file, 'uploads/family_registers');
        }
        if ($request->hasFile('attachment_birth_certificate')) {
            $file = $request->file('attachment_birth_certificate');
            $validated['attachment_birth_certificate'] = uploadFile($file, 'uploads/birth_certificates');
        }
        if ($request->hasFile('attachment_diploma')) {
            $file = $request->file('attachment_diploma');
            $validated['attachment_diploma'] = uploadFile($file, 'uploads/diplomas');
        }

        // Menambahkan user_id ke dalam data yang divalidasi
        $validated['user_id'] = Auth::user()->id;

        // Membuat data StudentRegistrant baru
        StudentRegistrant::create($validated);

        return redirect()->route('studentregistrant.home')->with('success', 'Pendaftaran berhasil dilakukan.');
    }

    // public function update(Request $request)
    // {
    //     $user = Auth::user()->StudentRegistrant;
    //     $validated = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'full_name' => 'required|string|max:255',
    //         'birth_date' => 'required|date',
    //         'address' => 'required|string',
    //         'education_sd' => 'required|string',
    //         'education_smp' => 'required|string',
    //         'nisn' => 'required|string|unique:student_registrants,nisn,' . $user->id,
    //         'sibling_info' => 'required|string',
    //         'quran_memorization' => 'required|integer',
    //         'achievements' => 'required|string',
    //         'school_motivation' => 'required|string',
    //         'major' => 'required|in:RPL,DKV',
    //         'father_name' => 'required|string',
    //         'father_occupation' => 'required|string',
    //         'father_income' => 'required|integer',
    //         'mother_name' => 'required|string',
    //         'mother_occupation' => 'required|string',
    //         'mother_income' => 'required|integer',
    //         'parent_whatsapp' => 'required|string',
    //         'student_status' => 'required|in:Yatim Piatu,Yatim,Piatu,Non Yatim Piatu',
    //     ]);

    //     $studentRegistrant = StudentRegistrant::findOrFail($user->id);
    //     $studentRegistrant->update($validated);
    //     return redirect()->route('studentregistrant.home')->with('success', 'User calon santri berhasil diubah.');
    // }
}
