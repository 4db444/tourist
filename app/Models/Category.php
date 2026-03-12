<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    protected $fillable = ["name"];

    public function itineraries () : BelongsToMany {
        return $this->belongsToMany(
            Itinerary::class,
            "itineraries_categories",
            "category_id",
            "itinerary_id"
        );
    }
}
