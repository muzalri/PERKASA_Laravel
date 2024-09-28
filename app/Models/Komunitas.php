<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komunitas extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'komunitas_category_id', 'title', 'body'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(KomunitasCategory::class);
    }

    public function likes()
    {
        return $this->hasMany(KomunitasLike::class);
    }

    // Menghitung jumlah like
    public function likesCount()
    {
        return $this->likes()->where('is_like', true)->count();
    }

    // Menghitung jumlah dislike
    public function dislikesCount()
    {
        return $this->likes()->where('is_like', false)->count();
    }
}
