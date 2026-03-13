<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Destination extends Model
{
    protected $fillable = [
        "title",
        "description",
        "accomidation"
    ];

    public function itinerary () :BelongsTo {
        return $this->belongsTo(Itinerary::class);
    }

    public function must_tries () : HasMany {
        return $this->hasMany(MustTry::class);
    }
}
