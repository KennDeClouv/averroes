<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Student;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    public function index()
    {
        $classes = Classes::all();
        return view('admin.classes.index', compact('classes'));
    }

    public function create()
    {
        return view('admin.classes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:classes,code',
        ], [
            'name.required' => 'Nama Kelas tidak boleh kosong!',
            'code.required' => 'Kode Kelas tidak boleh kosong!',
            'code.unique' => 'Kode Kelas sudah ada!',
        ]);

        Classes::create($validated);

        return redirect()->route('admin.class.index')->with('success', 'Kelas berhasil ditambahkan!');
    }

    public function show($id)
    {
        $class = Classes::findOrFail($id);
        return view('admin.classes.show', compact('class'));
    }

    public function edit($id)
    {
        $class = Classes::findOrFail($id);
        return view('admin.classes.edit', compact('class'));
    }

    public function update(Request $request, Classes $class)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:classes,code,' . $class->id,
        ], [
            'name.required' => 'Nama Kelas tidak boleh kosong!',
            'code.required' => 'Kode Kelas tidak boleh kosong!',
            'code.unique' => 'Kode Kelas sudah ada!',
        ]);
        $class->update($validated);
        return redirect()->route('admin.class.index')->with('success', 'Kelas berhasil diubah!');
    }

    public function destroy($id)
    {
        $class = Classes::findOrFail($id);
        $students = $class->Students;
        foreach ($students as $student) {
            $student->classes_id = null;
            $student->save();
        }
        $class->delete();

        return redirect()->route('admin.class.index')->with('success', 'Kelas berhasil dihapus!');
    }

    public function list($id)
    {
        $class = Classes::findOrFail($id);
        $students = $class->Students;
        return view('admin.classes.list', compact('class', 'students'));
    }
    public function deleteStudentFromClass(Student $student)
    {
        $student->classes_id = null;
        $student->save();

        return back()->with('success', 'Santri berhasil dihapus dari kelas!');
    }

    public function addStudentToClassForm(Classes $class)
    {
        $students = Student::where('classes_id', null)->get();
        return view('admin.classes.addlist', compact('class', 'students'));
    }
    public function addStudentToClass(Request $request, Classes $class)
    {
        $validated = $request->validate([
            'student_id' => 'required|array',
            'student_id.*' => 'required',
        ], [
            'student_id.required' => 'Santri tidak boleh kosong!',
            'student_id.*.required' => 'Santri tidak boleh kosong!',
        ]);

        foreach ($validated['student_id'] as $studentId) {
            $student = Student::findOrFail($studentId);
            $student->classes_id = $class->id;
            $student->save();
        }

        return redirect()->route('admin.class.list', $class->id)->with('success', 'Santri berhasil ditambahkan ke kelas!');
    }
}
