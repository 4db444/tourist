<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Itinerary extends Model
{
    protected $fillable = ["title", "duration", "image"];

    public function owner () : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function categories () : BelongsToMany {
        return $this->belongsToMany(
            Category::class,
            "itineraries_categories",
            "itinerary_id",
            "category_id"
        );
    }
}
