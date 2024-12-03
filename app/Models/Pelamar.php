<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelamar extends Model
{
    const STATUS_DITERIMA = 'diterima';
    const STATUS_DITOLAK = 'ditolak';
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'dob',
        'address',
        'education',
        'kategori_id',
        'photo',
        'status',
        'email',

    ];

    public function kategoriloker()
    {
        return $this->belongsTo(Kategoriloker::class);
    }
    public function setStatus($status)
    {
        if (in_array($status, [self::STATUS_DITERIMA, self::STATUS_DITOLAK])) {
            $this->status = $status;
            $this->save();
        }
    }
}
