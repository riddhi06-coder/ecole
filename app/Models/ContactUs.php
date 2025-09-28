<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    protected $table = 'contact_us';
    public $timestamps = false;

    protected $fillable = [
        'banner_heading',
        'banner_image',
        'email',
        'other_email',
        'map_url',
        'contact_number',

        'other_contact_number',
        'i_frame',
        'address',
        'desc',
        'announcements',
        'social_media_links',

        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
