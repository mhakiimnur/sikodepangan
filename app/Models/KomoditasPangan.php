<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KomoditasPangan extends Model
{
    protected $table = 'komoditas_pangans'; // pastikan sesuai dengan DB
    protected $primaryKey = 'kode_komoditas';
    public $incrementing = false; 
    protected $keyType = 'int'; 
    protected $fillable = ['kode_komoditas', 'nama_komoditas', 'kode_kelompok'];

    public function koneksi_kelompok()
    {
        return $this->belongsTo(KelompokPangan::class, 'kode_kelompok', 'kode_kelompok');
    }

    public function koneksi_jenis()
    {
        return $this->hasMany(JenisPangan::class, 'kode_komoditas', 'kode_komoditas');
    }
}
