<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    
    use HasFactory;

    protected $table = 'job_posting';
    public $timestamps = false;

    protected $fillable = [
        'job_category_id',
        'job_roles',

        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
