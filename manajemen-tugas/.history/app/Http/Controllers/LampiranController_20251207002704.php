<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LampiranController extends Controller
{
    public function index()
    {
        $lampiran = [];

        return view('pages.lampiran.index', [
            'pageTitle' => 'Lampiran',
            'lampiran' => $lampiran
        ]);
    }
}
