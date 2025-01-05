<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::where('target_id', 4)->get();
        return view('roles.Teacher.announcement.index', compact('announcements'));
    }

    public function create()
    {
                return view('roles.Teacher.announcement.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'target_id' => 'nullable|exists:roles,id',
            'date' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);
        Announcement::create($request->all());

                return redirect()->route('teacher.announcement.index')->with('success', 'Pengumuman berhasil dibuat.');

    }

    public function show(Announcement $announcement)
    {

                return view('roles.Teacher.announcement.show', compact('announcement'));

    }

    public function edit(Announcement $announcement)
    {

                return view('roles.Teacher.announcement.edit', compact('announcement'));

    }

    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'target_id' => 'nullable|exists:roles,id',
            'date' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);

        $announcement->update($request->all());
                return redirect()->route('teacher.announcement.index')->with('success', 'Pengumuman berhasil diubah.');

    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

                return redirect()->route('teacher.announcement.index')->with('success', 'Pengumuman berhasil dihapus.');

    }
}
