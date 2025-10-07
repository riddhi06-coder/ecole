<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

    protected $table = 'curriculum_overview';
    public $timestamps = false;

    protected $fillable = [
        'banner_heading',

        'banner_image',
        'ib_primary_desc',
        'ib_middle_desc',
        'ib_diploma_desc',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
