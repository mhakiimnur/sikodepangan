<?php

namespace App\Http\Controllers;

use App\Models\KelompokPangan;
use App\Models\KomoditasPangan;
use App\Models\JenisPangan;
use App\Models\LevelPangan;
use Illuminate\Http\Request;

class KelompokPanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = KelompokPangan::query('koneksi_komoditas.koneksi_jenis.koneksi_level');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('kode_kelompok', 'like', "%{$search}%")->orWhere('nama_kelompok', 'like', "%{$search}%"); 
        }
        $data_kelompok = $query->paginate(5)->withQueryString();
        return view('admin.kelompok.index', compact('data_kelompok'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $lastKode = KelompokPangan::max('kode_kelompok');

        // Jika ada data → increment, jika belum ada → mulai dari 10
        $nextKode = $lastKode ? $lastKode + 1 : 10;

        return view('admin.kelompok.create', compact('nextKode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $kode_kelompok)
    {
        //
        $kelompokPangan = KelompokPangan::where('kode_kelompok', $kode_kelompok)->firstOrFail();
        $data_komoditas = KomoditasPangan::where('kode_kelompok', $kode_kelompok)->paginate(10);

        // cari kode komoditas terakhir untuk kelompok ini
        $lastKode = KomoditasPangan::where('kode_kelompok', $kode_kelompok)->max('kode_komoditas');
        $nextKodeKomoditas = $lastKode ? $lastKode + 1 : ($kode_kelompok * 100) + 1;  
        // contoh: kalau kode_kelompok=11 → kode_komoditas mulai 1101

        return view('admin.kelompok.show', compact('kelompokPangan', 'data_komoditas', 'nextKodeKomoditas'));
        //$kelompokPangan = KelompokPangan::where('kode_kelompok', $kode_kelompok)->firstOrFail();
        //$data_komoditas = KomoditasPangan::where('kode_kelompok', $kode_kelompok)->paginate(10);
        //return view('admin.kelompok.show', compact('kelompokPangan', 'data_komoditas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $kode_kelompok)
    {
        //
        $kelompokPangan = KelompokPangan::where('kode_kelompok', $kode_kelompok)->firstOrFail();
        return view('admin.kelompok.edit', compact('kelompokPangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $kode_kelompok)
    {
        //
        $kelompokPangan = KelompokPangan::where('kode_kelompok', $kode_kelompok)->firstOrFail();
        $validated = $request->validate([
            'nama_kelompok' => 'required|string|max:255',
        ]);

        $kelompokPangan->update($validated);

        return redirect()->route('admin.kelompok.index')->with('success', 'Data Kelompok berhasil diperbarui');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $kode_kelompok)
    {
        //
        $kelompokPangan = KelompokPangan::where('kode_kelompok', $kode_kelompok)->firstOrFail();
        $kelompokPangan->delete();
        return redirect()->route('admin.kelompok.index')->with('success', 'Data Kelompok berhasil dihapus');
    }
}
