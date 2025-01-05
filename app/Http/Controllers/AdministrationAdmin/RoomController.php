<?php

namespace App\Http\Controllers\AdministrationAdmin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Student;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('roles.AdministrationAdmin.room.index', compact('rooms'));
    }

    public function create()
    {
        return view('roles.AdministrationAdmin.room.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:rooms,code',
        ], [
            'name.required' => 'Nama Kamar tidak boleh kosong!',
            'code.required' => 'Kode Kamar tidak boleh kosong!',
            'code.unique' => 'Kode Kamar sudah ada!',
        ]);

        Room::create($validated);

        return redirect()->route('administrationadmin.room.index')->with('success', 'Kamar berhasil ditambahkan!');
    }

    public function show($id)
    {
        $room = Room::findOrFail($id);
        return view('roles.AdministrationAdmin.room.show', compact('room'));
    }

    public function edit($id)
    {
        $room = Room::findOrFail($id);
        return view('roles.AdministrationAdmin.room.edit', compact('room'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:rooms,code,' . $id,
        ], [
            'name.required' => 'Nama Kamar tidak boleh kosong!',
            'code.required' => 'Kode Kamar tidak boleh kosong!',
            'code.unique' => 'Kode Kamar sudah ada!',
        ]);

        $room = Room::findOrFail($id);
        $room->update($validated);

        return redirect()->route('administrationadmin.room.index')->with('success', 'Kamar berhasil diubah!');
    }

    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $students = $room->Students;
        foreach ($students as $student) {
            $student->room_id = null;
            $student->save();
        }
        $room->delete();

        return redirect()->route('administrationadmin.room.index')->with('success', 'Kamar berhasil dihapus!');
    }

    public function list($id)
    {
        $room = Room::findOrFail($id);
        $students = $room->Students;
        return view('roles.AdministrationAdmin.room.list', compact('room', 'students'));
    }
    public function deleteStudentFromRoom(Student $student)
    {
        $student->room_id = null;
        $student->save();

        return back()->with('success', 'Santri berhasil dihapus dari kamar!');
    }

    public function addStudentToRoomForm(Room $room)
    {
        $students = Student::where('room_id', null)->get();
        return view('roles.AdministrationAdmin.room.addlist', compact('room', 'students'));
    }
    public function addStudentToRoom(Request $request, Room $room)
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
            $student->room_id = $room->id;
            $student->save();
        }

        return redirect()->route('administrationadmin.room.list', $room->id)->with('success', 'Santri berhasil ditambahkan ke kamar!');
    }
}
