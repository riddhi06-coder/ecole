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
        'order_id',
        't_id',
        'amount',
        'billing_name',
        'billing_address',
        'billing_city',
        'billing_state',
        'billing_zip',
        'billing_country',
        'billing_phone',
        'billing_email',
        'shipping_name',
        'shipping_address',
        'shipping_city',
        'shipping_state',
        'shipping_zip',
        'shipping_country',
        'shipping_phone',
        'shipping_email',
        
        'payment_status',
        'tracking_id',
        'bank_ref_no',
        'payment_mode',
        'order_status',
        'status_message',
        'currency',
        'application_status',
        'utm',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
