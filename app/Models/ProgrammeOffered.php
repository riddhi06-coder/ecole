<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgrammeOffered extends Model
{
    use HasFactory;

    protected $table = 'home_programs';
    public $timestamps = false;

    protected $fillable = [
        'section_title',
        'description',
        'image',
        'program',
        'url',
        'program_description',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
