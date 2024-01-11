<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;
    protected $fillable = ['judul', 'deskripsi', 'kelas_id', 'dosen_id', 'file'];

    public function dosen() {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }

    public function kelas()
    {
         return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function jawaban() {
        return $this->hasMany(Jawaban::class, 'tugas_id');
    }
}
