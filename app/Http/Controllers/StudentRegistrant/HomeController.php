<?php

namespace App\Http\Controllers\StudentRegistrant;

use App\Http\Controllers\Controller;
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'birth_place' => 'required|string',
            'address' => 'required|string',
            'education_sd' => 'required|string',
            'education_smp' => 'required|string',
            'nisn' => 'required|string|unique:student_registrants',
            'sibling_info' => 'required|string',
            'quran_memorization' => 'required|integer',
            'achievements' => 'required|string',
            'school_motivation' => 'required|string',
            'major' => 'required|in:RPL,DKV',
            'medical_history' => 'nullable',
            'father_name' => 'required|string',
            'father_occupation' => 'required|string',
            'father_income' => 'required|integer',
            'mother_name' => 'required|string',
            'mother_occupation' => 'required|string',
            'mother_income' => 'required|integer',
            'parent_whatsapp' => 'required|string',
            'quran_record_link' => 'required|string',
            'student_status' => 'required|in:Yatim Piatu,Yatim,Piatu,Non Yatim Piatu',
            'attachment_family_register' => 'nullable|file|mimes:jpg,png,pdf|max:5120',
            'attachment_birth_certificate' => 'nullable|file|mimes:jpg,png,pdf|max:5120',
            'attachment_diploma' => 'nullable|file|mimes:jpg,png,pdf|max:5120',
        ], [
            'name.required' => 'Nama harus diisi.',
            'full_name.required' => 'Nama lengkap harus diisi.',
            'birth_date.required' => 'Tanggal lahir harus diisi.',
            'birth_place.required' => 'Tempat lahir harus diisi.',
            'address.required' => 'Alamat harus diisi.',
            'education_sd.required' => 'Pendidikan SD harus diisi.',
            'education_smp.required' => 'Pendidikan SMP harus diisi.',
            'nisn.required' => 'NISN harus diisi.',
            'sibling_info.required' => 'Informasi saudara harus diisi.',
            'quran_memorization.required' => 'Jumlah hafalan Quran harus diisi.',
            'achievements.required' => 'Prestasi harus diisi.',
            'school_motivation.required' => 'Motivasi sekolah harus diisi.',
            'major.required' => 'Jurusan harus dipilih.',
            'father_name.required' => 'Nama ayah harus diisi.',
            'father_occupation.required' => 'Pekerjaan ayah harus diisi.',
            'father_income.required' => 'Pendapatan ayah harus diisi.',
            'mother_name.required' => 'Nama ibu harus diisi.',
            'mother_occupation.required' => 'Pekerjaan ibu harus diisi.',
            'mother_income.required' => 'Pendapatan ibu harus diisi.',
            'parent_whatsapp.required' => 'WhatsApp orang tua harus diisi.',
            'student_status.required' => 'Status siswa harus dipilih.',
            'quran_record_link.required' => 'Link rekaman bacaan quran harus diisi.',
        ]);

        // Menangani file upload
        if ($request->hasFile('attachment_family_register')) {
            $validated['attachment_family_register'] = $request->file('attachment_family_register')->store('attachments', 'public');
        }

        if ($request->hasFile('attachment_birth_certificate')) {
            $validated['attachment_birth_certificate'] = $request->file('attachment_birth_certificate')->store('attachments', 'public');
        }

        if ($request->hasFile('attachment_diploma')) {
            $validated['attachment_diploma'] = $request->file('attachment_diploma')->store('attachments', 'public');
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
