<?php

namespace App\Http\Controllers;

use App\Models\KelompokPangan;
use App\Models\KomoditasPangan;
use App\Models\JenisPangan;
use App\Models\LevelPangan;
use Illuminate\Http\Request;

class LevelPanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = LevelPangan::query('koneksi_kelompok.koneksi_jenis.koneksi_level');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('kode_level', 'like', "%{$search}%")->orWhere('nama_level', 'like', "%{$search}%"); 
        }
        $data_level = $query->paginate(10)->withQueryString();
        return view('admin.level.index', compact('data_level'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data_jenis = JenisPangan::all();
        return view('admin.level.create', compact('data_jenis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_jenis'  => 'required|exists:jenis_pangans,kode_jenis',
            'kategori'    => 'required', // produsen, penggilingan, konsumen, internasional
        ]);

        // Mapping kategori ke kode
        $mapping = [
            'produsen' => '01',
            'penggilingan' => '02',
            'konsumen' => '03',
            'internasional' => '04',
        ];

        $kodeKategori = $mapping[$validated['kategori']];
        $kodeLevel = $validated['kode_jenis'] . $kodeKategori;

        // Ambil nama_jenis
        $jenis = \App\Models\JenisPangan::find($validated['kode_jenis']);
        $namaLevel = $jenis->nama_jenis . ' Tingkat ' . ucfirst($validated['kategori']);

        // Simpan ke DB
        \App\Models\LevelPangan::create([
            'kode_jenis' => $validated['kode_jenis'],
            'kode_level' => $kodeLevel,
            'nama_level' => $namaLevel,
        ]);

        return redirect()->route('level.index')->with('success', 'Data Level berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(LevelPangan $levelPangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($kode_level)
    {
        $level = \App\Models\LevelPangan::findOrFail($kode_level);
        $jenis = \App\Models\JenisPangan::find($level->kode_jenis);

        $mapping = [
            'produsen' => '01',
            'penggilingan' => '02',
            'konsumen' => '03',
            'internasional' => '04',
        ];

        // Cari kategori yang sudah dipakai untuk kode_jenis ini
        $existingLevels = \App\Models\LevelPangan::where('kode_jenis', $level->kode_jenis)
            ->pluck('kode_level')
            ->toArray();

        $usedCategories = collect($existingLevels)->map(function($kodeLevel) {
            return substr($kodeLevel, -2);
        })->toArray();

        $available = [];
        foreach ($mapping as $key => $value) {
            if (!in_array($value, $usedCategories) || substr($level->kode_level, -2) === $value) {
                $available[] = [
                    'key' => $key,
                    'kode' => $value,
                    'label' => ucfirst($key) . " ($value)",
                ];
            }
        }

        return view('admin.level.edit', compact('level', 'jenis', 'available'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $kode_level)
    {
        //
        $levelPangan = LevelPangan::findOrFail($kode_level);
        
        $validated = $request->validate([
        'kategori' => 'required', // produsen, penggilingan, konsumen, internasional
    ]);

        $mapping = [
            'produsen' => '01',
            'penggilingan' => '02',
            'konsumen' => '03',
            'internasional' => '04',
        ];

        $kodeKategori = $mapping[$validated['kategori']];
        $kodeLevelBaru = $levelPangan->kode_jenis . $kodeKategori;

        $jenis = \App\Models\JenisPangan::find($levelPangan->kode_jenis);
        $namaLevelBaru = $jenis->nama_jenis . ' Tingkat ' . ucfirst($validated['kategori']);

        $levelPangan->update([
            'kode_level' => $kodeLevelBaru,
            'nama_level' => $namaLevelBaru,
        ]);

        return redirect()->route('level.index')->with('success', 'Data Level berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $kode_level)
    {
        //
        $levelPangan = LevelPangan::findOrFail($kode_level);

        $kodeJenis = $levelPangan->kode_jenis;

        $levelPangan->delete();
        
        return redirect()
            ->route('level.index')
            ->with('success', 'Level Pangan berhasil dihapus');
    }

    public function getAvailableCategories($kodeJenis)
    {
        // Mapping kategori fix
        $mapping = [
            'produsen' => '01',
            'penggilingan' => '02',
            'konsumen' => '03',
            'internasional' => '04',
        ];

        // Ambil kode_level yang sudah ada di DB
        $existingLevels = LevelPangan::where('kode_jenis', $kodeJenis)
            ->pluck('kode_level')
            ->toArray();

        // Ambil kode kategori yang sudah dipakai
        $usedCategories = collect($existingLevels)->map(function($kodeLevel) {
            return substr($kodeLevel, -2); // ambil 2 digit terakhir
        })->toArray();

        // Filter kategori yang masih available
        $available = [];
        foreach ($mapping as $key => $value) {
            if (!in_array($value, $usedCategories)) {
                $available[] = [
                    'key' => $key,
                    'kode' => $value,
                    'label' => ucfirst($key) . " (" . $value . ")",
                ];
            }
        }

        // Ambil nama_jenis untuk auto-generate nama_level
        $jenis = \App\Models\JenisPangan::find($kodeJenis);

        return response()->json([
            'available' => $available,
            'nama_jenis' => $jenis ? $jenis->nama_jenis : '',
        ]);
    }
}