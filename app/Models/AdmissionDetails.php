<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionDetails extends Model
{
    use HasFactory;

    protected $table = 'admission_details';
    public $timestamps = false;

    protected $fillable = [
        'form_type',
        'student_name',
        'dob',
        'address',
        'country_id',
        'city',
        'pincode',
        'present_school',

        'grade',
        'join_grade',
        'year',
        'nationality_id',
        'father_details',
        'mother_details',
        'passport_type',
        'foregin_passport_type',
        'specific_learning',
        'heard_from',
        'wish_you_know',

        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
