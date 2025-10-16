<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diploma extends Model
{
    use HasFactory;

    protected $table = 'diploma_details';
    public $timestamps = false;

    protected $fillable = [
        'banner_heading',
        'banner_image',
        'section_heading',
        'section_image',
        'small_intro',
        'program_heading',

        'program_image',
        'program_description',
        'framework_heading',
        'framework_image',
        'curriculum_description',
        'extra_info',

        'document',
        'doc_url',

        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
