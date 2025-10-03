<?php

namespace App\Http\Controllers;

use App\Models\KelompokPangan;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    //
    public function index(Request $request)
    {
        // Ambil keyword dari input search
        $keyword = $request->input('search');

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

        return view('welcome', compact('kelompokList','keyword')); // kirim juga keyword agar tetap muncul di input search
    }
}
