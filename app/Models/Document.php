<?php

namespace App\Models;

use App\Helpers\StringHelper;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Document
 *
 * @property int $id
 * @property int $user_id
 * @property string $filename
 * @property string $type
 * @property int $size
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $filepath
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Image> $images
 * @property-read int|null $images_count
 * @property-read mixed $images_absolute_path
 * @property-read mixed $images_relative_path
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document whereUserId($value)
 */
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
                . DS . 'public'
                . DS . $this->images_relative_path
            ),
        );
    }

    protected function imagesRelativePath(): Attribute
    {
        return Attribute::make(
            get: fn () => config('images.directory')
                . DS . StringHelper::trimExt($this->filename),
        );
    }
}
