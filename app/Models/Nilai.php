<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan oleh model.
     *
     * @var string
     */
    protected $table = 'scores';

    /**
     * Atribut-atribut yang dapat diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'nama_pelamar',
        'nilai_tes',
        'nilai_wawancara',
        'hasil_keputusan',
    ];

    /**
     * Atribut yang di-cast secara otomatis ke tipe data tertentu.
     *
     * @var array
     */
    protected $casts = [
        'nilai_tes' => 'integer',
        'nilai_wawancara' => 'integer',
        'hasil_keputusan' => 'string',
    ];
}