<?php

namespace App\Http\Controllers\AdministrationAdmin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentPermit;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentPermitController extends Controller
{
    public function index()
    {
        $studentPermits = StudentPermit::all();
        return view('AdministrationAdmin.student_permit.index', compact('studentPermits'));
    }

    public function create()
    {
        $students = Student::all();
        $teachers = Teacher::all();
        return view('AdministrationAdmin.student_permit.create', compact('students', 'teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'teacher_id' => 'required|exists:teachers,id',
            'from' => 'required',
            'to' => 'required',
            'reason' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'attachment' => 'nullable|string|max:255',
            'note' => 'nullable|string|max:255',
        ], [
            'student_id.required' => 'Santri harus dipilih.',
            'teacher_id.required' => 'Guru harus dipilih.',
            'from.required' => 'Dari waktu harus diisi.',
            'to.required' => 'Sampai waktu harus diisi.',
            'reason.required' => 'Sebab harus diisi.',
            'note.max' => 'Catatan maksimal 255 karakter.',
        ]);

        StudentPermit::create($request->all());
        return redirect()->route('administrationadmin.studentpermit.index')->with('success', 'Permohonan izin santri berhasil dibuat.');
    }

    public function show(StudentPermit $studentPermit)
    {
        return view('AdministrationAdmin.student_permit.show', compact('studentPermit'));
    }

    public function edit(StudentPermit $studentPermit)
    {
        $students = Student::all();
        $teachers = Teacher::all();
        return view('AdministrationAdmin.student_permit.edit', compact('studentPermit', 'students', 'teachers'));
    }

    public function update(Request $request, StudentPermit $studentPermit)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'teacher_id' => 'required|exists:teachers,id',
            'from' => 'required',
            'to' => 'required',
            'reason' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'attachment' => 'nullable|string|max:255',
            'note' => 'nullable|string|max:255',
        ], [
            'student_id.required' => 'Santri harus dipilih.',
            'teacher_id.required' => 'Guru harus dipilih.',
            'from.required' => 'Dari waktu harus diisi.',
            'to.required' => 'Sampai waktu harus diisi.',
            'reason.required' => 'Sebab harus diisi.',
            'note.max' => 'Catatan maksimal 255 karakter.',
        ]);
        $studentPermit->update($request->all());
        return redirect()->route('administrationadmin.studentpermit.index')->with('success', 'Permohonan izin santri berhasil diubah.');
    }

    public function destroy(StudentPermit $studentPermit)
    {
        $studentPermit->delete();
        return redirect()->route('administrationadmin.studentpermit.index')->with('success', 'Permohonan izin santri berhasil dihapus.');
    }

    public function approve(Request $request, StudentPermit $studentPermit)
    {
        $studentPermit->update(['status' => 'approved', 'note' => $request->note]);
        return back()->with('success', 'Permohonan izin santri berhasil disetujui.');
    }
}
