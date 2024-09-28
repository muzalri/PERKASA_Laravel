<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomunitasCategory extends Model
{
    protected $fillable = ['name'];

    public function komunitas()
    {
        return $this->hasMany(Komunitas::class);
    }
}
