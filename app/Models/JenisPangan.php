<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisPangan extends Model
{
    protected $table = 'jenis_pangans'; // pastikan sesuai dengan DB
    protected $primaryKey = 'kode_jenis';
    public $incrementing = false; 
    protected $keyType = 'int'; 
    protected $fillable = ['kode_jenis', 'nama_jenis', 'kode_komoditas'];

    public function koneksi_komoditas()
    {
        return $this->belongsTo(KomoditasPangan::class, 'kode_komoditas', 'kode_komoditas');
    }

    public function koneksi_level()
    {
        return $this->hasMany(LevelPangan::class, 'kode_jenis', 'kode_jenis');
    }
}
