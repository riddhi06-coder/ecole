<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IBDiploma extends Model
{
    use HasFactory;

    protected $table = 'ib_diploma';
    public $timestamps = false;

    protected $fillable = [
        'banner_heading',
        'banner_image',

        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
