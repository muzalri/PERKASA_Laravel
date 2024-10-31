<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'pakar_id', 'judul', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pakar()
    {
        return $this->belongsTo(User::class, 'pakar_id');
    }

    public function pesans()
    {
        return $this->hasMany(Pesan::class);
    }

    public function scopeWithLastMessageTime($query)
    {
        return $query->addSelect([
            'last_message_time' => Pesan::select('created_at')
                ->whereColumn('konsultasi_id', 'konsultasis.id')
                ->latest()
                ->limit(1)
        ])
        ->orderByDesc('last_message_time');
    }
}
