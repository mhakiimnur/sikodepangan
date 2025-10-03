<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KelompokPangan;
use App\Models\JenisPangan;
use App\Models\KomoditasPangan;
use App\Models\LevelPangan;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil keyword dari input search
        $keyword = $request->input('search');

        // Ambil ringkasan (count)
        $kelompokCount  = KelompokPangan::count();
        $jenisCount     = JenisPangan::count();
        $komoditasCount = KomoditasPangan::count();
        $levelCount     = LevelPangan::count();

        // Query dasar
        $query = KelompokPangan::with([
            'koneksi_komoditas.koneksi_jenis.koneksi_level'
        ]);

        // Jika ada keyword, filter
        if ($keyword) {
            $query->where('nama_kelompok', 'like', "%{$keyword}%")
                ->orWhereHas('koneksi_komoditas', function ($q) use ($keyword) {
                    $q->where('nama_komoditas', 'like', "%{$keyword}%");
                })
                ->orWhereHas('koneksi_komoditas.koneksi_jenis', function ($q) use ($keyword) {
                    $q->where('nama_jenis', 'like', "%{$keyword}%");
                })
                ->orWhereHas('koneksi_komoditas.koneksi_jenis.koneksi_level', function ($q) use ($keyword) {
                    $q->where('nama_level', 'like', "%{$keyword}%");
                });
        }

        $kelompokList = $query->get();

        return view('admin.dashboard', compact(
            'kelompokCount',
            'komoditasCount',
            'jenisCount',
            'levelCount',
            'kelompokList',
            'keyword' // kirim juga keyword agar tetap muncul di input search
        ));
    }

}
