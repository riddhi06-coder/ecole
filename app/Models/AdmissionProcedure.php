<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionProcedure extends Model
{
    use HasFactory;

    protected $table = 'admission_procedure';
    public $timestamps = false;

    protected $fillable = [
        'banner_image',
        'banner_heading',
        'section_heading',
        'title',
        'procedure',
        'description',

        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
