<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategoriloker extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function lowongan()
    {
        return $this->hasMany(Lowongan::class);
    }
}
