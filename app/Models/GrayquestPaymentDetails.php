<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrayquestPaymentDetails extends Model
{
    use HasFactory;

    protected $table = 'grayquest_payment_details';
    public $timestamps = false;

    protected $fillable = [
        'gr_no',
        'year',
        'student_name',
        'gq_student_id',
        'gq_application_id',
        'gq_reference_id',
        'gq_payment_status',
        'grade',
        'amount',
        
        'father_name',
        'mother_name',
        'father_mobile',
        'mother_mobile',
        'father_email',
        'mother_email',
        'student_address',
        
        
        'gq_customer_code',
        'gq_amount',
        'gq_type',
        'gq_send_status',
        
        'gq_emi_status',
        'gq_last_event',
        
        'gq_webhook_data',
        'gq_disbursed_at',
        
     
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
