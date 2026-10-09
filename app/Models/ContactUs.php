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

    /**
     * Announcements with a ready-to-use file URL.
     * Usage: $contact->announcement_list
     */
    public function getAnnouncementListAttribute(): array
    {
        $items = $this->announcements ? (json_decode($this->announcements, true) ?: []) : [];

        return array_map(function ($item) {
            $file = $item['file'] ?? null;

            return [
                'title'    => $item['title'] ?? '',
                'file'     => $file,
                'file_url' => $file ? asset('uploads/announcements/' . $file) : null,
            ];
        }, array_values($items));
    }
}