<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'pakar_id', 
        'judul', 
        'status_user',
        'status_pakar'
    ];

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

    // Scope untuk menampilkan konsultasi yang masih visible untuk user
    public function scopeVisibleForCurrentUser($query)
    {
        $user = auth()->user();
        
        if ($user->role === 'pakar') {
            return $query->where('pakar_id', $user->id)
                        ->where('status_pakar', 'active');
        } else {
            return $query->where('user_id', $user->id)
                        ->where('status_user', 'active');
        }
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

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId)
                    ->where('status_user', 'active');
    }

    public function scopeForPakar($query, $userId)
    {
        return $query->where('pakar_id', $userId)
                    ->where('status_pakar', 'active');
    }
}
