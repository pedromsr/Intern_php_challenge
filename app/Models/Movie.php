<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function review()
    {
        return $this->hasMany(Review::class);
    }
}
