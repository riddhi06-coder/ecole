<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulletinBoard extends Model
{
    use HasFactory;

    protected $table = 'home_bulletin';
    public $timestamps = false;

    protected $fillable = [
        'section_title',
        'description',
        'image',
        'title',
        'date',
        'bulletin_description',
        'slug',

        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
