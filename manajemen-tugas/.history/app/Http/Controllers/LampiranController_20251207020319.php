<?php


namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LampiranController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Cari kategori "Lampiran" (case insensitive)
        $kategoriLampiran = Category::whereRaw('LOWER(nama_kategori) = ?', ['lampiran'])->first();

        if (!$kategoriLampiran) {
            // Jika kategori belum ada, kembalikan view kosong
            return view('pages.lampiran.index', [
                'pageTitle' => 'Lampiran',
                'lampiran' => collect()
            ]);
        }

        // Ambil hanya tugas dengan kategori "Lampiran"
        $tasks = Task::where('user_id', $userId)
            ->where('category_id', $kategoriLampiran->id)
            ->with(['category', 'project'])
            ->orderBy('tanggal_deadline', 'asc')
            ->get();

        // Ambil proyek yang memiliki tugas dengan kategori "Lampiran"
        $projects = Project::where('user_id', $userId)
            ->whereHas('tasks', function($query) use ($kategoriLampiran) {
                $query->where('category_id', $kategoriLampiran->id);
            })
            ->orderBy('tanggal_selesai', 'asc')
            ->get();

        // Format data lampiran - gabungkan tugas dan proyek
        $lampiran = collect();

        // Tambahkan tugas ke lampiran
        foreach ($tasks as $task) {
            $lampiran->push([
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

        // Tambahkan proyek ke lampiran
        foreach ($projects as $project) {
            $lampiran->push([
                'judul' => $project->nama,
                'deskripsi' => $project->deskripsi ?? 'Tidak ada deskripsi',
                'tanggal' => Carbon::parse($project->tanggal_selesai)->format('d F Y'),
                'status' => $this->mapStatusProyek($project->status),
                'type' => 'proyek',
                'id' => $project->id,
                'progress' => $project->progress,
            ]);
        }

        return view('pages.lampiran.index', [
            'pageTitle' => 'Lampiran',
            'lampiran' => $lampiran
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
