<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;    
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.proyek.index', compact('projects'));
    }

    public function create()
    {
        return view('pages.proyek.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'deskripsi' => 'nullable',
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date',
        'status' => 'required',
        'progress' => 'nullable|integer|min:0|max:100',
    ]);

    Project::create([
        'nama' => $request->nama,
        'deskripsi' => $request->deskripsi,
        'tanggal_mulai' => $request->tanggal_mulai,
        'tanggal_selesai' => $request->tanggal_selesai,
        'status' => $request->status,
        'progress' => $request->progress ?? 0,
        'user_id' => auth()->id(),
    ]);

    return redirect()->route('proyek.index')
        ->with('success', 'Proyek berhasil dibuat!');
}
public function show($id)
{
    $project = Project::with(['anggota', 'tasks', 'komentar'])->findOrFail($id);

    // Ambil user yang belum menjadi anggota
    $users = User::whereNotIn('id', $project->anggota->pluck('id'))->get();

    return view('pages.proyek.detail', compact('project', 'users'));
}

public function addmember(request $request,$id)
{
    $project = Project::findOrFail($id);
    $project->anggota()->attach($request -> user_id);
if ($project->anggota()->where('user_id', $request->user_id)->exists()) {
    return back()->with('error', 'User sudah menjadi anggota proyek!');
}

    return redirect()->back()->with('Success','Anggota team berhasl ditambahkan!');

}

public function removeMember($project_id, $user_id)
{
    $project = Project::findOrFail($project_id);

    // Hapus relasi pivot (anggota tim)
    $project->anggota()->detach($user_id);

    return back()->with('success', 'Anggota berhasil dihapus!');
}


}
