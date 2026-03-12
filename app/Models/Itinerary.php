<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Itinerary extends Model
{
    protected $fillable = ["title", "duration", "image"];

    public function owner () : BelongsTo {
        return $this->belongsTo(User::class);
    }
}
