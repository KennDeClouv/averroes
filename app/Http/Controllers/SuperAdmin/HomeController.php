<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Announcement;
use App\Models\Student;
use App\Models\StudentPermit;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $role = Auth::user()->Role;
        $totalSantri = Student::count();
        $totalSantriAktif = Student::where('is_graduate', false)->count();
        $totalSantriNonAktif = Student::where('is_graduate', true)->count();
        $totalUstadz = Teacher::count();
        $totalIjin = StudentPermit::count();

        $startOfWeek = Carbon::now()->startOfWeek(-1);
        $endOfWeek = Carbon::now()->endOfWeek();

        $permits = StudentPermit::selectRaw('DATE(`from`) as date, COUNT(*) as count')
            ->whereBetween('from', [$startOfWeek, $endOfWeek])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $announcements = Announcement::where('status', 'active')
            ->where('target_id', $role->id)
            ->orderBy('date', direction: 'desc')
            ->take(2)
            ->get();

        return view("SuperAdmin.index", compact('totalSantri', 'totalSantriAktif', 'totalSantriNonAktif', 'totalUstadz', 'totalIjin', 'announcements', 'permits'));
    }
}
