<?php

namespace App\Http\Controllers\Teacher;

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
        $role = Auth::user()->Role->code;
        switch ($role) {
            case 'admin':
                $studentPermits = StudentPermit::all();
                return view('AdministrationAdmin.student-permit.index', compact('studentPermits'));

            case 'student':
                $studentPermits = StudentPermit::where('student_id', Auth::user()->Student->id)->get();
                return view('student.permit.index', compact('studentPermits'));

            case 'teacher':
                $studentPermits = StudentPermit::where('teacher_id', Auth::user()->Teacher->id)->get();
                return view('teacher.student-permit.index', compact('studentPermits'));
        }
    }
    public function create()
    {
        $role = Auth::user()->Role->code;
        switch ($role) {
            case 'admin':
                $students = Student::all();
                $teachers = Teacher::all();
                return view('AdministrationAdmin.student-permit.create', compact('students', 'teachers'));

            case 'student':
                $teachers = Teacher::all();
                return view('student.permit.create', compact('teachers'));

            case 'teacher':
                $students = Student::all();
                return view('teacher.student-permit.create', compact('students'));
        }
    }

    public function store(Request $request)
    {
        $role = Auth::user()->Role->code;
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
        switch ($role) {
            case 'admin':
                return redirect()->route('administrationadmin.student-permit.index')->with('success', 'Permohonan izin santri berhasil dibuat.');

            case 'student':
                return redirect()->route('student.permit.index')->with('success', 'Permohonan izin santri berhasil dibuat.');

            case 'teacher':
                return redirect()->route('teacher.student-permit.index')->with('success', 'Permohonan izin santri berhasil dibuat.');
        }
    }

    public function show(StudentPermit $studentPermit)
    {
        $role = Auth::user()->Role->code;
        switch ($role) {
            case 'admin':
                return view('AdministrationAdmin.student-permit.show', compact('studentPermit'));

            case 'student':
                return view('student.permit.show', compact('studentPermit'));

            case 'teacher':
                return view('teacher.student-permit.show', compact('studentPermit'));
        }
    }

    public function edit(StudentPermit $studentPermit)
    {
        $role = Auth::user()->Role->code;
        switch ($role) {
            case 'admin':
                $students = Student::all();
                $teachers = Teacher::all();
                return view('AdministrationAdmin.student-permit.edit', compact('studentPermit', 'students', 'teachers'));

            case 'student':
                $teachers = Teacher::all();
                return view('student.permit.edit', compact('studentPermit', 'teachers'));

            case 'teacher':
                $students = Student::all();
                return view('teacher.student-permit.edit', compact('studentPermit', 'students'));
        }
    }

    public function update(Request $request, StudentPermit $studentPermit)
    {
        $role = Auth::user()->Role->code;
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
        switch ($role) {
            case 'admin':
                return redirect()->route('administrationadmin.student-permit.index')->with('success', 'Permohonan izin santri berhasil diubah.');

            case 'student':
                return redirect()->route('student.permit.index')->with('success', 'Permohonan izin kamu berhasil diubah.');

            case 'teacher':
                return redirect()->route('teacher.student-permit.index')->with('success', 'Permohonan izin santri berhasil diubah.');
        }
    }

    public function destroy(StudentPermit $studentPermit)
    {
        $studentPermit->delete();
        $role = Auth::user()->Role->code;
        switch ($role) {
            case 'admin':
                return redirect()->route('administrationadmin.student-permit.index')->with('success', 'Permohonan izin santri berhasil dihapus.');
            case 'student':
                return redirect()->route('student.permit.index')->with('success', 'Permohonan izin kamu berhasil dihapus.');
            case 'teacher':
                return redirect()->route('teacher.student-permit.index')->with('success', 'Permohonan izin santri berhasil dihapus.');
        }
    }

    public function approve(Request $request, StudentPermit $studentPermit)
    {
        $studentPermit->update(['status' => 'approved', 'note' => $request->note]);
        return back()->with('success', 'Permohonan izin santri berhasil disetujui.');
    }
}
