<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function show(\App\Models\Event $event)
    {
        // Ambil data kategori untuk menu (jika diperlukan)
        $categories = \App\Models\Category::all();

        // Kirimkan data $event dan $categories ke halaman view 'event-detail'
        return view('event-detail', compact('categories', 'event'));
    }

    public function checkout() {
        return view('checkout');
    }
}
