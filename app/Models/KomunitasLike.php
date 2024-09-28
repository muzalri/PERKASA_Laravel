<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomunitasLike extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'komunitas_id', 'is_like'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function komunitas()
    {
        return $this->belongsTo(Komunitas::class);
    }
}
