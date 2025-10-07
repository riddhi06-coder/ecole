<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IBMiddle extends Model
{
    use HasFactory;

    protected $table = 'ib_middle';
    public $timestamps = false;

    protected $fillable = [
        'banner_heading',
        'banner_image',
        'ib_middle_desc',

        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
