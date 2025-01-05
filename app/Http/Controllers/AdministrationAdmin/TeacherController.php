<?php

namespace App\Http\Controllers\AdministrationAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequest;
use App\Http\Requests\UserRequest;
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
        return view('roles.AdministrationAdmin.teacher.index', compact('teachers'));
    }

    public function show(Teacher $teacher)
    {
        return view('roles.AdministrationAdmin.teacher.show', compact('teacher'));
    }

    public function create()
    {
        $classes = Classes::all();
        $rooms = Room::all();
        return view('roles.AdministrationAdmin.teacher.create', compact('classes', 'rooms'));
    }

    public function store(UserRequest $requestUser, TeacherRequest $teacherRequest)
    {
        $validatedUser = $requestUser->validated();
        $validatedTeacher = $teacherRequest->validated();
        $validatedUser["role_id"] = 3;
        $user = User::create($validatedUser);

        $validatedTeacher['user_id'] = $user->id;
        Teacher::create($validatedTeacher);

        return redirect()->route('administrationadmin.teacher.index')->with('success', 'Data ustadz berhasil ditambahkan');
    }

    public function edit(Teacher $teacher)
    {
        $classes = Classes::all();
        $rooms = Room::all();
        return view('roles.AdministrationAdmin.teacher.edit', compact('teacher', 'classes', 'rooms'));
    }

    public function update(UserRequest $userRequest, TeacherRequest $teacherRequest, Teacher $teacher)
    {
        $validatedUser = $userRequest->validated();
        $validatedTeacher = $teacherRequest->validated();
        $teacher->update($validatedTeacher);
        $teacher->User->update($validatedUser);

        return redirect()->route('administrationadmin.teacher.index')->with('success', 'Data ustadz berhasil diubah');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->User->delete();
        return redirect()->route('administrationadmin.teacher.index')->with('success', 'Data ustadz berhasil dihapus');
    }
}
