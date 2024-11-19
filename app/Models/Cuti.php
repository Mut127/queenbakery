<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tgl_awal',
        'tgl_akhir',
        'jml_cuti',
        'jenis',
        'ket',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
