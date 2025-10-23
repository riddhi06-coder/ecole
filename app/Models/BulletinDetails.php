<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulletinDetails extends Model
{
    use HasFactory;

    protected $table = 'bulletin_details';
    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'article_id',
        'thumbnail_image',
        'location',

        'article_time_from',
        'article_time_to',
        'title',
        'desc',

        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];

}
