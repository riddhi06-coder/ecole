<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactEnquiry extends Model
{
    use HasFactory;

    protected $table = 'contact_enquiry';
    public $timestamps = false;

    protected $fillable = [
        'form_type',
        'name',
        'email',
        'phone',
        'utm',
        'enquiry_type',
        'message',
        
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
