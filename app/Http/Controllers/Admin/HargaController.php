<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class HargaController extends Controller
{
    //
     public function index()
    {
        // Contoh fetch data API (dummy endpoint)
        $response = Http::get('https://panelharga.badanpangan.go.id/', [
            'komoditas' => 'beras',
            'wilayah_id' => '31' // contoh DKI Jakarta
        ]);

        $data = $response->json();

        return view('admin.harga.index', compact('data'));
    }
}
