<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreativityActivity extends Model
{
    use HasFactory;

    protected $table = 'creativity_activity';
    public $timestamps = false;

    protected $fillable = [
        'banner_heading',
        'banner_image',
        'section_heading', 
        'section_image',
        'title',        
        'detailed_page',    
        'description ',  
        'detailed_sections', 

        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
