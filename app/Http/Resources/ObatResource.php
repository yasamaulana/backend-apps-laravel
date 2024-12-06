<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ObatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'nama_obat' => $this->nama_obat,
            'kode_obat' => $this->kode_obat,
            'jenis_obat' => $this->jenis_obat,
            'stok' => $this->stok,
            'harga' => $this->harga,
        ];
    }
}