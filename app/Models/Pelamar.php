<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelamar extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'dob', 'address', 'education', 'institution_name', 
        'entry_year', 'exit_year', 'position', 'company_name', 
        'work_entry_year', 'work_exit_year', 'photo',
    ];
}