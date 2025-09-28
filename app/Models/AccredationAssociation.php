<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccredationAssociation extends Model
{
    use HasFactory;

    protected $table = 'association_accrediation';
    public $timestamps = false;

    protected $fillable = [
        'banner_image',
        'banner_heading',
        'section_desc',
        'section_heading',
        'org_name',
        'org_image',
        'org_desc',
        'gallery_images',

        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
