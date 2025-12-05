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

        // Total tugas user
        $totalTugas = Task::where('user_id', $userId)->count();

        // Tugas selesai
        $tugasSelesai = Task::where('user_id', $userId)
                            ->where('status', 'Selesai')
                            ->count();

        // Mendekati deadline (<= 3 hari)
        $deadlineDekat = Task::where('user_id', $userId)
                            ->where('status', '!=', 'Selesai')
                            ->whereNotNull('tanggal_deadline')
                            ->whereDate('tanggal_deadline', '>=', now())
                            ->whereDate('tanggal_deadline', '<=', now()->addDays(3))
                            ->count();

        // Proyek aktif → berdasarkan tanggal selesai
        $proyekAktif = Project::whereDate('tanggal_selesai', '>=', Carbon::today())->count();

        // Tugas terbaru
        $tugas = Task::where('user_id', $userId)
                        ->orderBy('created_at', 'desc')
                        ->limit(3)
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
