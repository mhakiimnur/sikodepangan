<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LevelPangan extends Model
{
    protected $table = 'level_pangans'; // pastikan sesuai dengan DB
    protected $primaryKey = 'kode_level';
    public $incrementing = false; 
    protected $keyType = 'int'; 
    protected $fillable = ['kode_level', 'nama_level', 'kode_jenis'];

    public function koneksi_jenis()
    {
        return $this->belongsTo(JenisPangan::class, 'kode_jenis', 'kode_jenis');
    }
}
