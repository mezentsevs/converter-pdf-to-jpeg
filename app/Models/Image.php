<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }
}
