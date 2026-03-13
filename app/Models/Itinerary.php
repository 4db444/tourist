<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Itinerary extends Model
{
    protected $fillable = ["title", "duration", "image"];

    public function owner () : BelongsTo {
        return $this->belongsTo(User::class, "user_id");
    }

    public function categories () : BelongsToMany {
        return $this->belongsToMany(
            Category::class,
            "itineraries_categories",
            "itinerary_id",
            "category_id"
        );
    }

    public function destinations () : HasMany {
        return $this->hasMany(Destination::class);
    }

    public function favorited_by () : BelongsToMany {
        return $this->belongsToMany(
            User::class,
            "favorities",
            "itinerary_id",
            "user_id"
        );
    }
}
