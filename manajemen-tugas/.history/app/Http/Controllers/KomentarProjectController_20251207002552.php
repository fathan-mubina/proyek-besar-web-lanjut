<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;

class KomentarProjectController extends Controller
{
    public function store(Request $request, $projectId)
    {
        $request->validate([
            'isi_komentar' => 'required'
        ]);

        Komentar::create([
            'project_id' => $projectId,
            'user_id' => auth()->id(),
            'isi_komentar' => $request->isi_komentar,
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $komentar = Komentar::where('user_id', auth()->id())
            ->findOrFail($id);

        $komentar->delete();

        return back()->with('success', 'Komentar berhasil dihapus!');
    }
}
