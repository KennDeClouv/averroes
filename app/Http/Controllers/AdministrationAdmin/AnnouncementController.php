<?php

namespace App\Http\Controllers\AdministrationAdmin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::all();
        return view('AdministrationAdmin.announcement.index', compact('announcements'));
    }

    public function create()
    {
        $role = Auth::user()->Role->code;
        switch ($role) {
            case 'admin':
                $targets = Role::all();
                return view('AdministrationAdmin.announcement.create', compact('targets'));
            case 'teacher':
                return view('teacher.announcement.create');
        }
    }

    public function store(Request $request)
    {
        $role = Auth::user()->Role->code;
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'target_id' => 'nullable|exists:roles,id',
            'date' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);
        Announcement::create($request->all());
        switch ($role) {
            case 'admin':
                return redirect()->route('administrationadmin.announcement.index')->with('success', 'Pengumuman berhasil dibuat.');
            case 'teacher':
                return redirect()->route('teacher.announcement.index')->with('success', 'Pengumuman berhasil dibuat.');
        }
    }

    public function show(Announcement $announcement)
    {
        $role = Auth::user()->Role->code;
        switch ($role) {
            case 'admin':
                return view('AdministrationAdmin.announcement.show', compact('announcement'));
            case 'teacher':
                return view('teacher.announcement.show', compact('announcement'));
        }
    }

    public function edit(Announcement $announcement)
    {
        $role = Auth::user()->Role->code;
        switch ($role) {
            case 'admin':
                $targets = Role::all();
                return view('AdministrationAdmin.announcement.edit', compact('announcement', 'targets'));
            case 'teacher':
                return view('teacher.announcement.edit', compact('announcement'));
        }
    }

    public function update(Request $request, Announcement $announcement)
    {
        $role = Auth::user()->Role->code;
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'target_id' => 'nullable|exists:roles,id',
            'date' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);

        $announcement->update($request->all());

        switch ($role) {
            case 'admin':
                return redirect()->route('administrationadmin.announcement.index')->with('success', 'Pengumuman berhasil diubah.');
            case 'teacher':
                return redirect()->route('teacher.announcement.index')->with('success', 'Pengumuman berhasil diubah.');
        }
    }

    public function destroy(Announcement $announcement)
    {
        $role = Auth::user()->Role->code;
        $announcement->delete();

        switch ($role) {
            case 'admin':
                return redirect()->route('administrationadmin.announcement.index')->with('success', 'Pengumuman berhasil dihapus.');
            case 'teacher':
                return redirect()->route('teacher.announcement.index')->with('success', 'Pengumuman berhasil dihapus.');
        }
    }
}
