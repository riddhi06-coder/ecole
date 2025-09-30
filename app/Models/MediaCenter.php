<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaCenter extends Model
{
    use HasFactory;

    protected $table = 'media_center';
    public $timestamps = false;

    protected $fillable = [
        'banner_heading',
        'banner_image',
        'section_heading',
        'section_image',
        'title',
        'url',
        'image',
        'description',


        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
