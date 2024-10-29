<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'no_hp',
        'alamat',
        'role',
        'profile_photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

        public function komunitas()
    {
        return $this->hasMany(Komunitas::class);
    }

    public function komunitasLikes()
    {
        return $this->hasMany(KomunitasLike::class);
    }

    public function komentars()
    {
        return $this->hasMany(Komentar::class, 'user_id');
    }

    public function konsultasisSebagaiUser()
    {
        return $this->hasMany(Konsultasi::class, 'user_id');
    }

    public function konsultasisSebagaiPakar()
    {
        return $this->hasMany(Konsultasi::class, 'pakar_id');
    }

    public function pesans()
    {
        return $this->hasMany(Pesan::class);
    }

    public function isPakar()
    {
        return $this->role === 'pakar';
    }
}
