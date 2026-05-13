<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner; 

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::all();
        return view('admin.partners.index', compact('partners'));
    }
    public function create()
    {
        return view('admin.partners.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'logo_url' => 'required|url' 
        ]);
        Partner::create($data);
        return redirect()->route('admin.partners.index')->with('success', 'Partner baru berhasil ditambahkan!');
    }
    public function destroy(Partner $partner)
    {
        // Menghapus data partner dari database
        $partner->delete();

        // Mengembalikan ke halaman index dengan pesan sukses
        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil dihapus secara permanen.');
    }
}