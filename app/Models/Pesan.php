<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;

    protected $fillable = ['konsultasi_id', 'user_id', 'isi', 'gambar', 'status', 'gambar'];

    public function konsultasi()
    {
        return $this->belongsTo(Konsultasi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
