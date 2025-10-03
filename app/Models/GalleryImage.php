<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    use HasFactory;

    protected $table = 'gallery_images';
    public $timestamps = false;

    protected $fillable = [
        'banner_image',
        'banner_heading',
        'event_name',
        'slug',
        'thumbnail_image',
        'gallery_images',

        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
