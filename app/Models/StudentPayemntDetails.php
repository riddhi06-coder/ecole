<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPayemntDetails extends Model
{
    use HasFactory;

    protected $table = 'student_payment_details';
    public $timestamps = false;

    protected $fillable = [
        'gr_no',
        'year',
        'student_name',
        'grade',
        'amount',
        'selected_amount',
        'razorpay_order_id',
        
        'emi_1',
        'emi_2',
        'emi_3',
        'father_name',
        'mother_name',
        'father_mobile',
        'mother_mobile',
        'father_email',
        'mother_email',
        'student_address',
     
        'payment_reference_id',
        'status',
        'emi1_details',
        'emi2_details',
        'emi3_details',
        'fullamount_details',
        'razorpay_payment_id',
        
        
        'emi1_failed_details',
        'emi2_failed_details',
        'emi3_failed_details',
        'fullamount_failed_details',
        
     
        'amount_paid',
        'payment_date',
       
        'pay_status',


        'invoice_number',


     
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
