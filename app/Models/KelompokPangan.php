<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelompokPangan extends Model
{
    //
    protected $table = 'kelompok_pangans';
    protected $primaryKey = 'kode_kelompok';
    public $incrementing = false; // Karena primary key bukan auto-increment
    protected $keyType = 'Integer'; // Tipe data primary key
    protected $fillable = ['kode_kelompok', 'nama_kelompok'];

    public function koneksi_komoditas()
    {
        return $this->hasMany(KomoditasPangan::class, 'kode_kelompok', 'kode_kelompok');
    }
}
