<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengingatController extends Controller
{
    public function index()
    {
        // Dummy data dulu
        $pengingat = [
            [
                'tanggal' => '21 November 2025',
                'judul'   => 'Laporan Praktikum Biseksi'
            ],
            [
                'tanggal' => '21 November 2025',
                'judul'   => 'Laporan Praktikum Biseksi'
            ],
            [
                'tanggal' => '21 November 2025',
                'judul'   => 'Laporan Praktikum Biseksi'
            ],
            [
                'tanggal' => '21 November 2025',
                'judul'   => 'Laporan Praktikum Biseksi'
            ],
        ];

        return view('pages.pengingat.index', [
            'pageTitle' => 'Pengingat',
            'pengingat' => $pengingat
        ]);
    }
}
