<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutTestimonial extends Model
{
    use HasFactory;

    protected $table = 'about_testimony';
    public $timestamps = false;

    protected $fillable = [
        'banner_image',
        'banner_heading',
        'section_image',
        'section_heading',
        'reviewer',
        'testimony',

        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
