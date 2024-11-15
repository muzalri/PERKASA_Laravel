<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuideBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'category_id',
        'image_path',
        'video_path'
    ];

    public function category_id()
    {
        return $this->belongsTo(KomunitasCategory::class, 'category_id');
    }
}
