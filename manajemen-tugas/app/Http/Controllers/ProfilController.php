<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index()
    {
        return view('pages.profil.index', [
            'user' => auth()->user(),
            'pageTitle' => 'Profil'
        ]);
    }

    public function edit()
    {
        return view('pages.profil.edit', [
            'user' => auth()->user(),
            'pageTitle' => 'Edit Profil'
        ]);
    }

    public function update(Request $request)
{
    $user = auth()->user();

    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->password) {
        $user->password = bcrypt($request->password);
    }

    $user->save();

    return redirect()->route('profil.index')->with('success', 'Profil berhasil diperbarui');
}

}
