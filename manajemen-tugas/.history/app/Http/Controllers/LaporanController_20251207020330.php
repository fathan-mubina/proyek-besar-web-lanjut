<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Cari kategori "Laporan" (case insensitive)
        $kategoriLaporan = Category::whereRaw('LOWER(nama_kategori) = ?', ['laporan'])->first();

        if (!$kategoriLaporan) {
            // Jika kategori belum ada, kembalikan view kosong
            return view('pages.laporan.index', [
                'pageTitle' => 'Laporan',
                'laporan' => collect()
            ]);
        }

        // Ambil hanya tugas dengan kategori "Laporan"
        $tasks = Task::where('user_id', $userId)
            ->where('category_id', $kategoriLaporan->id)
            ->with(['category', 'project'])
            ->orderBy('tanggal_deadline', 'asc')
            ->get();

        // Ambil proyek yang memiliki tugas dengan kategori "Laporan"
        $projects = Project::where('user_id', $userId)
            ->whereHas('tasks', function($query) use ($kategoriLaporan) {
                $query->where('category_id', $kategoriLaporan->id);
            })
            ->orderBy('tanggal_selesai', 'asc')
            ->get();

        // Format data laporan - gabungkan tugas dan proyek
        $laporan = collect();

        // Tambahkan tugas ke laporan
        foreach ($tasks as $task) {
            $laporan->push([
                'judul' => $task->judul,
                'deskripsi' => $task->deskripsi,
                'tanggal' => Carbon::parse($task->tanggal_deadline)->format('d F Y'),
                'status' => $this->mapStatusTugas($task->status),
                'type' => 'tugas',
                'id' => $task->id,
                'prioritas' => $task->prioritas,
                'kategori' => $task->category->nama_kategori ?? '-',
            ]);
        }

        // Tambahkan proyek ke laporan
        foreach ($projects as $project) {
            $laporan->push([
                'judul' => $project->nama,
                'deskripsi' => $project->deskripsi ?? 'Tidak ada deskripsi',
                'tanggal' => Carbon::parse($project->tanggal_selesai)->format('d F Y'),
                'status' => $this->mapStatusProyek($project->status),
                'type' => 'proyek',
                'id' => $project->id,
                'progress' => $project->progress,
            ]);
        }

        return view('pages.laporan.index', [
            'pageTitle' => 'Laporan',
            'laporan' => $laporan
        ]);
    }

    // Mapping status tugas ke format view
    private function mapStatusTugas($status)
    {
        $mapping = [
            'Belum Mulai' => 'Belum Mulai',
            'Proses' => 'Dalam Proses',
            'Selesai' => 'Selesai',
        ];

        return $mapping[$status] ?? $status;
    }

    // Mapping status proyek ke format view
    private function mapStatusProyek($status)
    {
        $mapping = [
            'Belum Mulai' => 'Belum Mulai',
            'Proses' => 'Dalam Proses',
            'Selesai' => 'Selesai',
        ];

        return $mapping[$status] ?? $status;
    }
}
