<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReferensiPanganResource;
use App\Models\KelompokPangan;
use App\Models\KomoditasPangan;
use App\Models\JenisPangan;
use App\Models\LevelPangan;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ReferensiPanganController extends Controller
{
    use ApiResponse;

    // ==========================
    // TABEL KODE REFERENSI PANGAN
    // ==========================

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

        return view('admin.dashboard', compact(
            'kelompokCount',
            'jenisCount',
            'komoditasCount',
            'levelCount',
            'kelompokList',
            'keyword' // kirim juga keyword agar tetap muncul di input search
        ));
    }

    // ==========================
    // KELompok PANGAN
    // ==========================

    public function kelompok(Request $request)
    {
        $query = KelompokPangan::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->orWhere('kode_kelompok', 'LIKE', "%{$search}%")
                  ->orWhere('nama_kelompok', 'LIKE', "%{$search}%");
            });
        }

        $sort_by = $request->get('sort_by', 'created_at');
        $sort_order = $request->get('sort_order', 'asc');
        $query->orderBy($sort_by, $sort_order);

        $data = $query->get();

        return $this->successResponse(
            ReferensiPanganResource::collection($data),
            'Daftar Kelompok Pangan'
        );
    }

    public function kelompokByKode($kode)
    {
        $data = KelompokPangan::where('kode_kelompok', $kode)->get();
        return $this->successResponse(
            ReferensiPanganResource::collection($data),
            'Kelompok Pangan berdasarkan kode'
        );
    }

    // ==========================
    // KOMODITAS PANGAN
    // ==========================

    public function komoditas(Request $request)
    {
        $query = KomoditasPangan::with('koneksi_kelompok');

        if ($request->has('kelompok') && $request->kelompok != '') {
            $query->where('kode_kelompok', $request->kelompok);
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->orWhere('kode_komoditas', 'LIKE', "%{$search}%")
                  ->orWhere('nama_komoditas', 'LIKE', "%{$search}%");
            });
        }

        $sort_by = $request->get('sort_by', 'created_at');
        $sort_order = $request->get('sort_order', 'asc');
        $query->orderBy($sort_by, $sort_order);

        $data = $query->get();

        return $this->successResponse(
            ReferensiPanganResource::collection($data),
            'Daftar Komoditas Pangan'
        );
    }

    public function komoditasByKode($kode)
    {
        $data = KomoditasPangan::where('kode_komoditas', $kode)->get();
        return $this->successResponse(
            ReferensiPanganResource::collection($data),
            'Komoditas Pangan berdasarkan kode'
        );
    }

    public function komoditasByKelompok(Request $request)
    {
        $kode_kelompok = $request->query('kode_kelompok');

        if (!$kode_kelompok) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kode kelompok harus diisi.'
            ], 400);
        }

        $data = KomoditasPangan::where('kode_kelompok', $kode_kelompok)->get();

        return $this->successResponse(
            ReferensiPanganResource::collection($data),
            'Daftar Komoditas Pangan Berdasarkan Kelompok Pangan'
        );
    }

    // ==========================
    // JENIS PANGAN
    // ==========================

    public function jenis(Request $request)
    {
        $query = JenisPangan::with(['koneksi_komoditas', 'koneksi_level']);

        if ($request->has('komoditas') && $request->komoditas != '') {
            $query->where('kode_komoditas', $request->komoditas);
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->orWhere('kode_jenis', 'LIKE', "%{$search}%")
                  ->orWhere('nama_jenis', 'LIKE', "%{$search}%");
            });
        }

        $sort_by = $request->get('sort_by', 'created_at');
        $sort_order = $request->get('sort_order', 'asc');
        $query->orderBy($sort_by, $sort_order);

        $data = $query->get();

        return $this->successResponse(
            ReferensiPanganResource::collection($data),
            'Daftar Jenis Pangan'
        );
    }

    public function jenisByKode($kode)
    {
        $data = JenisPangan::where('kode_jenis', $kode)->get();
        return $this->successResponse(
            ReferensiPanganResource::collection($data),
            'Jenis Pangan berdasarkan kode'
        );
    }

    public function jenisByKomoditas(Request $request)
    {
        $kode_komoditas = $request->query('kode');

        if (!$kode_komoditas) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kode komoditas harus diisi.'
            ], 400);
        }

        $data = JenisPangan::where('kode_komoditas', $kode_komoditas)->get();

        return $this->successResponse(
            ReferensiPanganResource::collection($data),
            'Daftar Jenis Pangan Berdasarkan Komoditas Pangan'
        );
    }

    // ==========================
    // LEVEL PANGAN
    // ==========================

    public function level(Request $request)
    {
        $query = LevelPangan::with('koneksi_jenis');

        if ($request->has('jenis') && $request->jenis != '') {
            $query->where('kode_jenis', $request->jenis);
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->orWhere('kode_level', 'LIKE', "%{$search}%")
                  ->orWhere('nama_level', 'LIKE', "%{$search}%");
            });
        }

        $sort_by = $request->get('sort_by', 'created_at');
        $sort_order = $request->get('sort_order', 'asc');
        $query->orderBy($sort_by, $sort_order);

        $data = $query->get();

        return $this->successResponse(
            ReferensiPanganResource::collection($data),
            'Daftar Level Pangan'
        );
    }

    public function levelByKode($kode)
    {
        $data = LevelPangan::where('kode_level', $kode)->get();
        return $this->successResponse(
            ReferensiPanganResource::collection($data),
            'Level Pangan berdasarkan kode'
        );
    }

    public function levelByJenis(Request $request)
    {
        $kode_jenis = $request->query('kode');

        if (!$kode_jenis) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kode jenis harus diisi.'
            ], 400);
        }

        $data = LevelPangan::where('kode_jenis', $kode_jenis)->get();

        return $this->successResponse(
            ReferensiPanganResource::collection($data),
            'Daftar Level Pangan Berdasarkan Jenis Pangan'
        );
    }

    // ==========================
    // HIERARKI PANGAN (baru)
    // ==========================

    public function getAllKode()
    {
        $data = KelompokPangan::with([
            'koneksi_komoditas.koneksi_jenis.koneksi_level'
        ])->get();

        return $this->successResponse(
            $data,
            'Daftar Kode Referensi Pangan Lengkap: Kelompok → Komoditas → Jenis → Level'
        );
    }
}
