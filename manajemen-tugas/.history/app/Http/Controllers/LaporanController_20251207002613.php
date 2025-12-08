<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Statistik tugas
        $totalTugas = Task::where('user_id', $userId)->count();
        $tugasSelesai = Task::where('user_id', $userId)
            ->where('status', 'Selesai')->count();
        $tugasProses = Task::where('user_id', $userId)
            ->where('status', 'Proses')->count();
        $tugasBelumMulai = Task::where('user_id', $userId)
            ->where('status', 'Belum Mulai')->count();

        // Statistik proyek
        $totalProyek = Project::where('user_id', $userId)->count();
        $proyekSelesai = Project::where('user_id', $userId)
            ->where('status', 'Selesai')->count();

        // Tugas per kategori
        $tugasPerKategori = Task::where('user_id', $userId)
            ->with('category')
            ->get()
            ->groupBy('category.nama_kategori')
            ->map(fn($group) => $group->count());

        // Tugas terlambat
        $tugasTerlambat = Task::where('user_id', $userId)
            ->where('status', '!=', 'Selesai')
            ->whereDate('tanggal_deadline', '<', Carbon::today())
            ->count();

        return view('pages.laporan.index', [
            'pageTitle' => 'Laporan',
            'totalTugas' => $totalTugas,
            'tugasSelesai' => $tugasSelesai,
            'tugasProses' => $tugasProses,
            'tugasBelumMulai' => $tugasBelumMulai,
            'totalProyek' => $totalProyek,
            'proyekSelesai' => $proyekSelesai,
            'tugasPerKategori' => $tugasPerKategori,
            'tugasTerlambat' => $tugasTerlambat
        ]);
    }
