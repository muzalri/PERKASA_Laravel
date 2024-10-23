<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuideBook extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'category', 'image_path', 'video_path'];
}