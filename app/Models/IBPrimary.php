<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IBPrimary extends Model
{
    use HasFactory;

    protected $table = 'ib_primary';
    public $timestamps = false;

    protected $fillable = [
        'banner_heading',
        'banner_image',
        'ib_primary_desc',

        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
