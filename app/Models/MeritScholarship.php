<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeritScholarship extends Model
{
    use HasFactory;

    protected $table = 'scholarship';
    public $timestamps = false;

    protected $fillable = [
        'banner_image',
        'banner_heading',
        'campus_tour',
        'section_heading',
        'description',
        'admission_advisor',
        'brochure',

        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
