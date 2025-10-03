<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ReferensiPanganResource extends JsonResource
{
    public function toArray($request)
    {
        $class = class_basename($this->resource);

        switch ($class) {
            
            case 'KelompokPangan':
                return [
                    'kode_kelompok' => $this->kode_kelompok,
                    'nama_kelompok' => $this->nama_kelompok,
                    // 'created_at' => $this->formatTimestamp($this->created_at),
                    // 'updated_at' => $this->formatTimestamp($this->updated_at),
                ];

            case 'KomoditasPangan':
                return [
                    'kode_komoditas' => $this->kode_komoditas,
                    'nama_komoditas' => $this->nama_komoditas,
                    'kode_kelompok' => ReferensiPanganResource::make($this->whenLoaded('koneksi_kelompok')),
                    // 'created_at' => $this->formatTimestamp($this->created_at),
                    // 'updated_at' => $this->formatTimestamp($this->updated_at),
                ];

            case 'JenisPangan':
                return [
                    'kode_jenis' => $this->kode_jenis,
                    'nama_jenis' => $this->nama_jenis,
                    'komoditas' => ReferensiPanganResource::make($this->whenLoaded('koneksi_komoditas')),
                    //'level' => ReferensiPanganResource::make($this->whenLoaded('koneksi_level')),
                    // 'created_at' => $this->formatTimestamp($this->created_at),
                    // 'updated_at' => $this->formatTimestamp($this->updated_at),
                ];

            case 'LevelPangan':
                return [
                    'kode_level' => $this->kode_level,
                    'nama_level' => $this->nama_level,
                    'jenis' => ReferensiPanganResource::make($this->whenLoaded('koneksi_jenis')),
                    // 'created_at' => $this->formatTimestamp($this->created_at),
                    // 'updated_at' => $this->formatTimestamp($this->updated_at),
                ];

            default:
                return parent::toArray($request);
        }
    }

    private function formatTimestamp($value)
    {
        return $value 
            ? Carbon::parse($value)->timezone('Asia/Jakarta')->format('d-m-Y H:i:s') 
            : null;
    }
}
