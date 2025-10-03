<?php

namespace App\Http\Controllers;

use App\Models\KelompokPangan;
use App\Models\KomoditasPangan;
use App\Models\JenisPangan;
use App\Models\LevelPangan;
use Illuminate\Http\Request;

class JenisPanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = JenisPangan::query('koneksi_kelompok.koneksi_jenis.koneksi_level');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('kode_jenis', 'like', "%{$search}%")->orWhere('nama_jenis', 'like', "%{$search}%"); 
        }
        $data_jenis = $query->paginate(10)->withQueryString();
        return view('admin.jenis.index', compact('data_jenis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data_komoditas = KomoditasPangan::all();
        return view('admin.jenis.create', compact('data_komoditas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'kode_komoditas' => 'required',
            'kode_jenis'     => 'required|integer|unique:jenis_pangans,kode_jenis',
            'nama_jenis'     => 'required|string|max:100',
        ]);

        $jenis = new JenisPangan();
        $jenis->kode_komoditas = $validated['kode_komoditas'];
        $jenis->kode_jenis = $validated['kode_jenis'];
        $jenis->nama_jenis = $validated['nama_jenis'];
        $jenis->save();

        return redirect()
            ->route('jenis.index', $jenis->kode_komoditas)
            ->with('success', 'Jenis Pangan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $kode_jenis)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $kode_jenis)
    {
        //
        $jenisPangan = JenisPangan::where('kode_jenis', $kode_jenis)->firstOrFail();
        $data_komoditas = KomoditasPangan::all();
        return view('admin.jenis.edit', compact('jenisPangan', 'data_komoditas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $kode_jenis)
    {
        //
        $jenisPangan = JenisPangan::findOrFail( $kode_jenis);
        
        $validated = $request->validate([
            'nama_jenis'     => 'required|string|max:100',
        ]);
        
        $jenisPangan->update([
            'nama_jenis' => $validated['nama_jenis'],
        ]);

        return redirect()
            ->route('jenis.index', $jenisPangan->kode_komoditas)
            ->with('success', 'Jenis pangan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $kode_jenis)
    {
        //
        $jenisPangan = JenisPangan::findorFail($kode_jenis);
        $kodeKomoditas = $jenisPangan->kode_komoditas;

        $jenisPangan->delete();
        
        return redirect()
            ->route('jenis.index')
            ->with('success', 'Jenis Pangan berhasil dihapus');
    }

    public function getLastJenis($kode_komoditas)
    {
        // Cari jenis terakhir berdasarkan kode_komoditas
        $last = JenisPangan::where('kode_komoditas', $kode_komoditas)
                    ->orderBy('kode_jenis', 'desc')
                    ->first();

        if ($last) {
            // Ambil 2 digit terakhir dari kode_jenis
            $lastUrut = (int) substr($last->kode_jenis, strlen($kode_komoditas));
            $nextUrut = str_pad($lastUrut + 1, 2, '0', STR_PAD_LEFT);
        } else {
            // Kalau belum ada jenis sama sekali → mulai dari 01
            $nextUrut = "01";
        }

        // Bentuk kode jenis = kode_komoditas (4 digit) + urut (2 digit)
        $nextKode = $kode_komoditas . $nextUrut;

        return response()->json(['nextKode' => $nextKode]);
    }
}