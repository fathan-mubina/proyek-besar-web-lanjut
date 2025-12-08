<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LampiranController extends Controller
{
    public function index()
    {
        // Dummy data
        $lampiran = [
            [
                'judul' => 'Laporan Praktikum Biseksi',
                'deskripsi' => 'Membuat video dan melakukan simulasi troubleshooting jaringan.',
                'tanggal' => '21 November 2025',
                'status1' => 'Sedang',
                'status2' => 'Belum Mulai',
            ],
            [
                'judul' => 'Laporan Praktikum Adminjar',
                'deskripsi' => 'Membuat video dan melakukan simulasi troubleshooting jaringan.',
                'tanggal' => '21 November 2025',
                'status1' => 'Dalam Proses',
                'status2' => null,
            ],
        ];

        return view('pages.lampiran.index', [
            'pageTitle' => 'Lampiran',
            'lampiran' => $lampiran
        ]);
    }
}
