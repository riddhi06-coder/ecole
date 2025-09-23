<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeFestivities extends Model
{
    use HasFactory;

    protected $table = 'home_festivities';
    public $timestamps = false;

    protected $fillable = [
        'image',
        'heading',
        'description',
        'slug',

        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
