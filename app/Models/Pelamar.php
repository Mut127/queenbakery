<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelamar extends Model
{
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
        'position',
        'photo',
        'kategoriloker_id',
    ];

    public function kategoriloker()
    {
        return $this->belongsTo(Kategoriloker::class);
    }
}