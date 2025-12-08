<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();


        $totalTugas = Task::where('user_id', $userId)->count();


        $tugasSelesai = Task::where('user_id', $userId)
            ->where('status', 'Selesai')
            ->count();


        $deadlineDekat = Task::where('user_id', $userId)
            ->where('status', '!=', 'Selesai')
            ->whereNotNull('tanggal_deadline')
            ->whereDate('tanggal_deadline', '>=', Carbon::today())
            ->whereDate('tanggal_deadline', '<=', Carbon::today()->addDays(3))
            ->count();


        $proyekAktif = Project::where('user_id', $userId)
            ->where('status', '!=', 'Selesai')
            ->count();


        $tugas = Task::where('user_id', $userId)
            ->with(['category', 'project'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('pages.dashboard.index', compact(
            'totalTugas',
            'tugasSelesai',
            'deadlineDekat',
            'proyekAktif',
            'tugas'
        ));
    }
}
