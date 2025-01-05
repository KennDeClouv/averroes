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
        return view('roles.AdministrationAdmin.announcement.index', compact('announcements'));
    }

    public function create()
    {
        $targets = Role::all();
        return view('roles.AdministrationAdmin.announcement.create', compact('targets'));
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
        return redirect()->route('administrationadmin.announcement.index')->with('success', 'Pengumuman berhasil dibuat.');
    }

    public function show(Announcement $announcement)
    {
        return view('roles.AdministrationAdmin.announcement.show', compact('announcement'));
    }
    public function edit(Announcement $announcement)
    {
        $targets = Role::all();
        return view('roles.AdministrationAdmin.announcement.edit', compact('announcement', 'targets'));
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

        return redirect()->route('administrationadmin.announcement.index')->with('success', 'Pengumuman berhasil diubah.');
    }
    public function destroy(Announcement $announcement)
    {
        $role = Auth::user()->Role->code;
        $announcement->delete();
        return redirect()->route('administrationadmin.announcement.index')->with('success', 'Pengumuman berhasil dihapus.');
    }
}
