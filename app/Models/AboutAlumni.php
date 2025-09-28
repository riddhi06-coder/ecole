<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutAlumni extends Model
{
    use HasFactory;

    protected $table = 'about_alumni';
    public $timestamps = false;

    protected $fillable = [
        'banner_image',
        'banner_heading',
        'alumni_email',
        'alumni_image',
        'alumni_name',
        'alumni_desc',
        'section_description',

        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
