<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeachingApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'apply', 'name', 'position_applied', 'gender', 'dob', 'nationality_id',
        'marital_status', 'childs_name', 'childs_age', 'current_address', 'zipcode',
        'landline_no', 'mobile_no', 'permanent_address', 'availability_date', 'email',
        'notice_period', 'skype_id', 'criminal_offence', 'photo_path',
        'passport_no', 'passport_issue_place', 'passport_issue_date', 'passport_expiry_date',
        'education', 'pd_courses_attended', 'pd_courses_conducted', 'publications', 'referees',
        'experience_international_schools', 'supervisor_concern', 'direct_experience_in',
        'current_employer', 'experience_years', 'experience_months', 'current_designation',
        'employment', 'it_skills', 'hobbies', 'language_skills',
        'current_salary', 'expected_salary', 'philosophy', 'other_information', 'resume_path','utm'
    ];

    protected $casts = [
        'education' => 'array',
        'pd_courses_attended' => 'array',
        'pd_courses_conducted' => 'array',
        'publications' => 'array',
        'referees' => 'array',
        'employment' => 'array',
    ];
}
