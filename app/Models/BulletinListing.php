<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulletinListing extends Model
{
    use HasFactory;

    protected $table = 'bulletin_listing';
    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'thumbnail_image',
        'article_name',
        'article_date',
        'article_author',
        'special_tags',
        'short_desc',
        'slug',

        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];

    public function category() {
        return $this->belongsTo(BulletinCategory::class, 'category_id');
    }
}
