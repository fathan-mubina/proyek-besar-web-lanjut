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
            ->withCount('tasks')
            ->orderBy('created_at', 'desc')
            ->get();

        // Update progress setiap proyek
        foreach ($projects as $project) {
            $project->updateProgress();
        }

        return view('pages.proyek.index', compact('projects'));
    }

    public function create()
    {
        return view('pages.proyek.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'deskripsi' => 'nullable',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:Belum Mulai,Proses,Selesai',
        ]);

        $project = Project::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => $request->status,
            'progress' => 0, // Default 0, akan dihitung otomatis
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('proyek.index')
            ->with('success', 'Proyek berhasil dibuat!');
    }

    public function show($id)
    {
        $project = Project::with(['anggota', 'tasks', 'komentar.user'])
            ->findOrFail($id);

        // Update progress sebelum ditampilkan
        $project->updateProgress();

        // Ambil user yang belum menjadi anggota
        $existingMemberIds = $project->anggota->pluck('id')->push($project->user_id);
        $users = User::whereNotIn('id', $existingMemberIds)->get();

        return view('pages.proyek.detail', compact('project', 'users'));
    }

    public function edit($id)
    {
        $project = Project::where('user_id', auth()->id())
            ->findOrFail($id);

        return view('pages.proyek.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'deskripsi' => 'nullable',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:Belum Mulai,Proses,Selesai',
        ]);

        $project = Project::where('user_id', auth()->id())
            ->findOrFail($id);

        $project->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => $request->status,
        ]);

        // Update progress setelah edit
        $project->updateProgress();

        return redirect()->route('proyek.index')
            ->with('success', 'Proyek berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $project = Project::where('user_id', auth()->id())
            ->findOrFail($id);

        $project->delete();

        return redirect()->route('proyek.index')
            ->with('success', 'Proyek berhasil dihapus!');
    }

    public function addMember(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        // Cek apakah user sudah menjadi anggota
        if ($project->anggota()->where('user_id', $request->user_id)->exists()) {
            return back()->with('error', 'User sudah menjadi anggota proyek!');
        }

        // Tambahkan anggota
        $project->anggota()->attach($request->user_id);

        return redirect()->back()
            ->with('success', 'Anggota tim berhasil ditambahkan!');
    }

    public function removeMember($project_id, $user_id)
    {
        $project = Project::findOrFail($project_id);

        // Hapus relasi pivot (anggota tim)
        $project->anggota()->detach($user_id);

        return back()->with('success', 'Anggota berhasil dihapus!');
    }
}
