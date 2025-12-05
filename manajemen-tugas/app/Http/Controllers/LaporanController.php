<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        // dummy data sementara
        $laporan = [
            [
                'judul' => 'Laporan Praktikum Biseksi',
                'deskripsi' => 'Membuat video dan melakukan simulasi troubleshooting jaringan.',
                'tanggal' => '21 November 2025',
                'status' => 'Sedang'
            ],
            [
                'judul' => 'Laporan Praktikum Adminjar',
                'deskripsi' => 'Membuat video dan melakukan simulasi troubleshooting jaringan.',
                'tanggal' => '21 November 2025',
                'status' => 'Dalam Proses'
            ]
        ];

        return view('pages.laporan.index', [
            'pageTitle' => 'Laporan',
            'laporan' => $laporan
        ]);
    }
}

