<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kelas', 'dosen_id'];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }
}
