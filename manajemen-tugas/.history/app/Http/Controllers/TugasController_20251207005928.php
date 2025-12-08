<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Request;

class TugasController extends Controller {
    public function index() {
        $tugas = Task::where( 'user_id', auth()->id() )
        ->with( [ 'category', 'project' ] )
        ->orderBy( 'tanggal_deadline', 'asc' )
        ->get();

        return view( 'pages.tugas.index', compact( 'tugas' ) );
    }

    public function create( Request $request ) {
        $project_id = $request->project_id;
        $categories = Category::all();

        return view( 'pages.tugas.create', compact( 'project_id', 'categories' ) );
    }

    public function store( Request $request ) {
        $request->validate( [
            'judul' => 'required|max:255',
            'deskripsi' => 'required',
            'status' => 'required|in:Belum Mulai,Sedang,Selesai',
            'prioritas' => 'required|in:Rendah,Sedang,Tinggi',
            'deadline' => 'required|date',
            'kategori' => 'nullable|exists:categories,id',
            'project_id' => 'nullable|exists:projects,id'
        ] );

        // Mapping status & prioritas
        $statusMap = [
            'Belum Mulai' => 'Belum Mulai',
            'Sedang' => 'Proses',
            'Selesai' => 'Selesai'
        ];

        $prioritasMap = [
            'Rendah' => 'rendah',
            'Sedang' => 'sedang',
            'Tinggi' => 'tinggi',
        ];

        $categoryId = null;
        if ( !$request->project_id && $request->kategori ) {
            $categoryId = $request->kategori;
        }

        Task::create( [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'status' => $statusMap[ $request->status ],
            'prioritas' => $prioritasMap[ $request->prioritas ],
            'tanggal_deadline' => $request->deadline,
            'category_id' => $categoryId,
            'project_id' => $request->project_id,
            'user_id' => auth()->id(),
        ] );

        if ( $request->project_id ) {
            return redirect()->route( 'proyek.detail', $request->project_id )
            ->with( 'success', 'Tugas proyek berhasil dibuat!' );
        }

        return redirect()->route( 'tugas.index' )
        ->with( 'success', 'Tugas berhasil dibuat!' );
    }

    public function edit( $id ) {
        $tugas = Task::where( 'user_id', auth()->id() )
        ->findOrFail( $id );
        $categories = Category::all();

        return view( 'pages.tugas.edit', compact( 'tugas', 'categories' ) );
    }

    public function update( Request $request, $id ) {
        $request->validate( [
            'judul' => 'required|max:255',
            'deskripsi' => 'required',
            'status' => 'required',
            'prioritas' => 'required',
            'deadline' => 'required|date',
            'kategori' => 'nullable|exists:categories,id'
        ] );

        $tugas = Task::where( 'user_id', auth()->id() )
        ->findOrFail( $id );

        $statusMap = [
            'Belum Mulai' => 'Belum Mulai',
            'Sedang'      => 'Proses',
            'Proses'      => 'Proses',
            'Selesai'     => 'Selesai',
        ];

        $prioritasMap = [
            // Support Title Case
            'Rendah' => 'rendah',
            'Sedang' => 'sedang',
            'Tinggi' => 'tinggi',
            'rendah' => 'rendah',
            'sedang' => 'sedang',
            'tinggi' => 'tinggi',
        ];

        $tugas->update( [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'status' => $statusMap[ $request->status ] ?? $request->status,
            'prioritas' => $prioritasMap[ $request->prioritas ] ?? strtolower( $request->prioritas ),
            'category_id' => $request->project_id ? null : $request->kategori,
            'tanggal_deadline' => $request->deadline,
        ] );

        return redirect()->route( 'tugas.index' )
        ->with( 'success', 'Tugas berhasil diperbarui!' );
    }

    public function destroy( $id ) {
        $task = Task::where( 'user_id', auth()->id() )
        ->findOrFail( $id );
        $task->delete();

        return redirect()->route( 'tugas.index' )
        ->with( 'success', 'Tugas berhasil dihapus!' );
    }
}
