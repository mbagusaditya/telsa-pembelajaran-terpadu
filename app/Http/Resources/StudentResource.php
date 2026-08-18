<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // 1. Identitas Utama & Identifier
            'id' => $this->id,
            'name' => $this->name,
            'nis' => $this->nis,
            'nisn' => $this->nisn,
            'nik' => $this->nik,

            // 2. Data Kelahiran (Raw & Display Ready)
            'born_place' => $this->born_place,
            'born_date' => $this->born_date?->format('Y-m-d'),
            'birth_info' => "{$this->born_place}, ".($this->born_date ? $this->born_date->translatedFormat('d F Y') : '-'),
            'age' => $this->born_date ? $this->born_date->age : null,

            // 3. Status Akademik & Status Siswa
            'admission_year' => $this->admission_year,
            'status' => $this->status, // e.g. 'active', 'graduated', 'moved'

            // 4. Relasi (Gunakan whenLoaded agar hemat query / anti N+1)
            'user' => new UserResource($this->whenLoaded('user')),
            'creator' => new UserResource($this->whenLoaded('creator')),

            // 5. Timestamps & Audit Info
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
            'created_at_formatted' => $this->created_at?->translatedFormat('d M Y H:i'),
        ];
    }
}
