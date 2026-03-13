<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MustTry extends Model
{
    protected $table = "must_try";

    protected $fillable = [
        "title",
        "type"
    ];

    public function destination () : BelongsTo {
        return $this->belongsTo(Destination::class);
    }
}
