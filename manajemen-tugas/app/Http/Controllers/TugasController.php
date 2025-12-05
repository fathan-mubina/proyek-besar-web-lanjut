<?php

namespace App\Http\Controllers;
use App\Models\Task;


use Illuminate\Http\Request;

class TugasController extends Controller
{
   public function index()
{
    $tugas = Task::where('user_id', auth()->id())->get();
    return view('pages.tugas.index', compact('tugas'));
}


    public function create(Request $request)
{
    $project_id = $request->project_id; 
    return view('pages.tugas.create', compact('project_id'));
}


public function store(Request $request)
{
    $request->validate([
        'judul' => 'required',
        'deskripsi' => 'required',
        'status' => 'required',
        'prioritas' => 'required',
        'deadline' => 'required|date',
        'kategori' => 'nullable',
        'project_id' => 'nullable|integer'
    ]);

    // Mapping status & prioritas ke format ENUM database
    $statusMap = [
        'Belum Mulai' => 'Belum Mulai',
        'Sedang'      => 'Proses',
        'Selesai'     => 'Selesai'
    ];

    $prioritasMap = [
        'Rendah' => 'rendah',
        'Sedang' => 'sedang',
        'Tinggi' => 'tinggi',
    ];

    
  
    $categoryId = null;

    if (!$request->project_id && $request->kategori) {
        // Pastikan kategori valid
        $exists = \DB::table('categories')->where('id', $request->kategori)->exists();
        $categoryId = $exists ? $request->kategori : null;
    }

   
    // Create Tugas
    Task::create([
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'status' => $statusMap[$request->status] ?? 'Belum Mulai',
        'prioritas' => $prioritasMap[$request->prioritas] ?? 'sedang',
        'tanggal_deadline' => $request->deadline,

        // kategori boleh null
        'category_id' => $categoryId,

        'project_id' => $request->project_id,
        'user_id' => auth()->id(),
    ]);

 
    // Redirect Jika tugas terkait proyek, kembali ke detail proyek
  
    if ($request->project_id) {
        return redirect()->route('proyek.detail', $request->project_id)
            ->with('success', 'Tugas proyek berhasil dibuat!');
    }
    // Redirect ke daftar tugas umum
    return redirect()->route('tugas.index')
        ->with('success', 'Tugas berhasil dibuat!');
}


    public function edit($id)
{
    $tugas = Task::findOrFail($id);
    return view('pages.tugas.edit', compact('tugas'));
}

public function update(Request $request, $id)
{
    $tugas = Task::findOrFail($id);

   $statusMap = [
        'Belum Mulai' => 'Belum Mulai',
        'Sedang'      => 'Proses',
        'Proses'      => 'Proses',
        'Selesai'     => 'Selesai',
    ];

    $prioritasMap = [
        'Rendah' => 'rendah',
        'Sedang' => 'sedang',
        'Tinggi' => 'tinggi',
    ];

    $tugas->update([
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi, 

        // 🔥 Wajib gunakan mapping
        'status' => $statusMap[$request->status],
        'prioritas' => $prioritasMap[$request->prioritas],

        // Kategori dan Project
        'category_id' => $request->project_id ? null : $request->kategori,
        // Deadline disimpan di kolom yang benar
        'tanggal_deadline' => $request->deadline,
    ]);

    return redirect()->route('tugas.index')->with('success', 'Tugas berhasil diperbarui!');
}


public function destroy($id)
{
    $task = Task::findOrFail($id);
    $task->delete();

    return redirect()->route('tugas.index')->with('success', 'Tugas berhasil dihapus!');
}


}
