<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeStructure extends Model
{
    use HasFactory;

    protected $table = 'fee_structures';
    public $timestamps = false;

    protected $fillable = [
        'banner_image',
        'banner_heading',
        'section_heading',
        'section_description',

        'campus_tour',
        'admission_advisor',
        'brochure',
        'fee_type',
        'fee_desc',
        'fees_details',

        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
