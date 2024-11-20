<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    protected $fillable = [
        'name',
        'tgl_awal',
        'tgl_dl',
        'deskripsi',
        'kategori_id',
    ];
    public function kategoriloker()
    {
        return $this->belongsTo(Kategoriloker::class, 'kategori_id');
    }
}
