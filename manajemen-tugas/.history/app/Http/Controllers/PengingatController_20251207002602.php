<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PengingatController extends Controller
{
    public function index()
    {
        // Ambil tugas yang deadline-nya dalam 7 hari ke depan
        $pengingat = Task::where('user_id', auth()->id())
            ->where('status', '!=', 'Selesai')
            ->whereNotNull('tanggal_deadline')
            ->whereDate('tanggal_deadline', '>=', Carbon::today())
            ->whereDate('tanggal_deadline', '<=', Carbon::today()->addDays(7))
            ->orderBy('tanggal_deadline', 'asc')
            ->get()
            ->map(function($task) {
                return [
                    'id' => $task->id,
                    'tanggal' => Carbon::parse($task->tanggal_deadline)->format('d F Y'),
                    'judul' => $task->judul,
                    'prioritas' => $task->prioritas,
                    'sisa_hari' => Carbon::today()->diffInDays($task->tanggal_deadline)
                ];
            });

        return view('pages.pengingat.index', [
            'pageTitle' => 'Pengingat',
            'pengingat' => $pengingat
        ]);
    }
}
