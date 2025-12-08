<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
public function index()
{
    $categories = Category::withCount('tugas')->get();

    return view('pages.kategori.index', [
        'pageTitle' => 'Kategori',
        'categories' => $categories
    ]);
}


}
