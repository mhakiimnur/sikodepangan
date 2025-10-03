<?php

namespace App\Http\Controllers;

use App\Models\KelompokPangan;
use App\Models\KomoditasPangan;
use App\Models\JenisPangan;
use App\Models\LevelPangan;
use Illuminate\Http\Request;

class KomoditasPanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = KomoditasPangan::query('koneksi_kelompok.koneksi_jenis.koneksi_level');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('kode_komoditas', 'like', "%{$search}%")->orWhere('nama_komoditas', 'like', "%{$search}%"); 
        }
        $data_komoditas = $query->paginate(10)->withQueryString();
        return view('admin.komoditas.index', compact('data_komoditas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data_kelompok = KelompokPangan::all();
        return view('admin.komoditas.create', compact('data_kelompok'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'kode_kelompok'  => 'required',
            'kode_komoditas' => 'required|integer|unique:komoditas_pangans,kode_komoditas',
            'nama_komoditas' => 'required|string|max:100',
        ]);

        $komoditas = new KomoditasPangan();
        $komoditas->kode_kelompok = $validated['kode_kelompok'];
        $komoditas->kode_komoditas = $validated['kode_komoditas'];
        $komoditas->nama_komoditas = $validated['nama_komoditas'];
        $komoditas->save();

        return redirect()
            ->route('komoditas.index', $komoditas->kode_kelompok)
            ->with('success', 'Komoditas Pangan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $kode_komoditas)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $kode_komoditas)
    {
        //
        $komoditasPangan = KomoditasPangan::where('kode_komoditas', $kode_komoditas)->firstOrFail();
        $data_kelompok = KelompokPangan::all();
        return view('admin.komoditas.edit', compact('komoditasPangan', 'data_kelompok'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $kode_komoditas)
    {
        //
        $komoditasPangan = KomoditasPangan::findOrFail($kode_komoditas);
        
        $validated = $request->validate([
            'nama_komoditas' => 'required|string|max:100',
        ]);

        $komoditasPangan->update([
            'nama_komoditas' => $validated['nama_komoditas'],
        ]);

        return redirect()
            ->route('komoditas.index', $komoditasPangan->kode_kelompok)
            ->with('success','Komoditas Pangan berhasil diperbaharui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $kode_komoditas)
    {
        //
        $komoditasPangan = KomoditasPangan::findOrFail($kode_komoditas);
        $kodeKelompok = $komoditasPangan->kode_kelompok;
        
        $komoditasPangan->delete();

        return redirect()
            ->route('komoditas.index', $kodeKelompok)
            ->with('success', 'Data Komoditas berhasil dihapus.');
    }

    public function getLastKomoditas($kode_kelompok)
    {
        // Ambil kode terakhir sesuai kelompok
        $last = KomoditasPangan::where('kode_kelompok', $kode_kelompok)
                    ->orderBy('kode_komoditas', 'desc')
                    ->first();

        if ($last) {
            // Ambil urutan terakhir (2 digit terakhir dari kode_komoditas)
            $lastUrut = (int) substr($last->kode_komoditas, strlen($kode_kelompok));
            $nextUrut = str_pad($lastUrut + 1, 2, '0', STR_PAD_LEFT);
        } else {
            // Kalau belum ada → mulai dari 01
            $nextUrut = "01";
        }

        // Kode baru = kode_kelompok + urutan 2 digit
        $nextKode = $kode_kelompok . $nextUrut;

        return response()->json(['nextKode' => $nextKode]);
    }
}

