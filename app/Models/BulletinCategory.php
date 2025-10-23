<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulletinCategory extends Model
{
    use HasFactory;

    protected $table = 'bulletin_category';
    public $timestamps = false;

    protected $fillable = [
        'banner_heading',
        'banner_image',
        'category',
        'slug',

        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];

    public function listings()
    {
        return $this->hasMany(BulletinListing::class, 'category_id');
    }

    // BulletinCategory.php
    public function details()
    {
        return $this->hasMany(BulletinDetails::class, 'category_id');
    }

}
