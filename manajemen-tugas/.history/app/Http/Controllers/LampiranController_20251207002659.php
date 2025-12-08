<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LampiranController extends Controller
{
    public function index()
    {
        // Untuk lampiran, biasanya terkait dengan file upload
        // Sementara tetap dummy karena belum ada tabel lampiran
        $lampiran = [];

        return view('pages.lampiran.index', [
            'pageTitle' => 'Lampiran',
            'lampiran' => $lampiran
        ]);
    }
}
