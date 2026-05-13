<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index(Request $request)
{
    // 1. Ambil semua jenis kategori untuk tampilan filter tab button
    $categories = Category::all();

    // 2. Buat kueri dasar (Eager loading category & jadwal belum kedaluwarsa)
    $query = Event::with('category')
        ->orderBy('date', 'asc');

    // 3. Filter query jika url memiliki parameter pencarian spesifik ?category=...
    if ($request->has('category') && $request->category != '') {
        $query->whereHas('category', function ($q) use ($request) {
            $q->where('slug', $request->category);
        });
    }

    // 4. Eksekusi query dan kirim data hasilnya ke template Blade
    $events = $query->get();
    return view('welcome', compact('events', 'categories'));
}
}
