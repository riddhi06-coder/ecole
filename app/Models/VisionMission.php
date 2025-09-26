<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisionMission extends Model
{
    use HasFactory;

    protected $table = 'vision_mission';
    public $timestamps = false;

    protected $fillable = [
        'banner_heading',
        'banner_image',
        'section_image',
        'section_heading',
        'section_image1',
        'division_details',
        'gallery_images',
        'features_table',

        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
