<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function reviewer()
    {
        return $this->belongsTo(Reviewer::class);
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
