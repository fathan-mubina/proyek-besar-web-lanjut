<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('user_id', auth()->id())
            ->orderBy('tanggal_selesai', 'asc')
            ->get();

        return view('pages.proyek.index', [
            'pageTitle' => 'Proyek',
            'projects' => $projects
        ]);
    }

    public function create()
    {
        return view('pages.proyek.create', [
            'pageTitle' => 'Tambah Proyek'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'deskripsi' => 'nullable',
            'status' => 'required|in:Belum Mulai,Proses,Selesai',
            'progress' => 'required|numeric|min:0|max:100',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai'
        ]);

        Project::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status,
            'progress' => $request->progress,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'user_id' => auth()->id()
        ]);

        return redirect()->route('proyek.index')
            ->with('success', 'Proyek berhasil ditambahkan!');
    }

    public function show($id)
    {
        $project = Project::where('user_id', auth()->id())
            ->with('tasks.category')
            ->findOrFail($id);

        return view('pages.proyek.detail', [
            'pageTitle' => $project->nama,
            'project' => $project,
            'users'
        ]);
    }

    public function edit($id)
    {
        $project = Project::where('user_id', auth()->id())
            ->findOrFail($id);

        return view('pages.proyek.edit', [
            'pageTitle' => 'Edit Proyek',
            'project' => $project
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'deskripsi' => 'nullable',
            'status' => 'required|in:Belum Mulai,Proses,Selesai',
            'progress' => 'required|numeric|min:0|max:100',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai'
        ]);

        $project = Project::where('user_id', auth()->id())
            ->findOrFail($id);

        $project->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status,
            'progress' => $request->progress,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai
        ]);

        return redirect()->route('proyek.index')
            ->with('success', 'Proyek berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $project = Project::where('user_id', auth()->id())
            ->findOrFail($id);


        $project->tasks()->delete();

        $project->delete();

        return redirect()->route('proyek.index')
            ->with('success', 'Proyek berhasil dihapus!');
    }
}
