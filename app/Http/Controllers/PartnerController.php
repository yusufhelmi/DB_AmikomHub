<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner; 

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        // Buat query dasar
        $query = Partner::query();

        // Jika ada input pencarian, saring datanya
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        // Eksekusi query
        $partners = $query->get();

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
    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'logo_url' => 'required|string', // Asumsi menggunakan link URL/Teks. Jika Anda kemarin menggunakan file upload, sesuaikan bagian ini.
        ]);

        // Update data ke database
        $partner->update([
            'name' => $request->name,
            'logo_url' => $request->logo_url,
        ]);

        // Kembalikan ke halaman index dengan pesan sukses
        return redirect()->route('admin.partners.index')->with('success', 'Data partner berhasil diperbarui!');
    }
    public function destroy(Partner $partner)
    {
        // Menghapus data partner dari database
        $partner->delete();

        // Mengembalikan ke halaman index dengan pesan sukses
        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil dihapus secara permanen.');
    }
}