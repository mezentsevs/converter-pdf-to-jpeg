<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Document extends Model
{
    protected $fillable = [
        'filename',
        'type',
        'size',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    protected function filepath(): Attribute
    {
        return Attribute::make(
            get: fn () => storage_path('app'
                . DS . 'private'
                . DS . config('documents.directory')
                . DS . $this->filename
            ),
        );
    }

    protected function imagesAbsolutePath(): Attribute
    {
        return Attribute::make(
            get: fn () => storage_path('app'
                . DS . 'private'
                . DS . $this->images_relative_path
            ),
        );
    }

    protected function imagesRelativePath(): Attribute
    {
        return Attribute::make(
            get: fn () => config('images.directory')
                . DS . substr($this->filename, 0, -4),
        );
    }
}
