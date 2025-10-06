<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversityColleges extends Model
{
    use HasFactory;

    protected $table = 'university_college_counselling';
    public $timestamps = false;

    protected $fillable = [
        'country_id',
        'name',
        'url',
        'status',
        
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
