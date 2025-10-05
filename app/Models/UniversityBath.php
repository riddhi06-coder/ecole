<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversityBath extends Model
{
    use HasFactory;

    protected $table = 'university_of_bath';
    public $timestamps = false;

    protected $fillable = [
        'banner_image',
        'banner_heading',
        'section_heading',
        'videos_url',

        'section_description',
        'unit_heading',
        'bkg_image',
        'units_offered',

        'desc',
        'documents',

        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
