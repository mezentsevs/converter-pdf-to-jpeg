<?php

namespace App\Models;

use App\Helpers\StringHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Document
 *
 * @property int $id
 * @property int $user_id
 * @property string $filename
 * @property string $type
 * @property int $size
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read mixed $filepath
 * @property-read Collection<int, Image> $images
 * @property-read int|null $images_count
 * @property-read mixed $archive_absolute_path
 * @property-read mixed $archive_relative_path
 * @property-read mixed $images_absolute_path
 * @property-read mixed $images_relative_path
 * @property-read mixed $slider_absolute_path
 * @property-read mixed $slider_relative_path
 * @property-read User $user
 * @method static Builder<static>|Document newModelQuery()
 * @method static Builder<static>|Document newQuery()
 * @method static Builder<static>|Document query()
 * @method static Builder<static>|Document whereCreatedAt($value)
 * @method static Builder<static>|Document whereFilename($value)
 * @method static Builder<static>|Document whereId($value)
 * @method static Builder<static>|Document whereSize($value)
 * @method static Builder<static>|Document whereType($value)
 * @method static Builder<static>|Document whereUpdatedAt($value)
 * @method static Builder<static>|Document whereUserId($value)
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

    protected function sliderRelativePath(): Attribute
    {
        return Attribute::make(
            get: fn () => config('sliders.directory')
                . DS . StringHelper::trimExt($this->filename),
        );
    }

    protected function sliderAbsolutePath(): Attribute
    {
        return Attribute::make(
            get: fn () => storage_path('app'
                . DS . 'public'
                . DS . $this->slider_relative_path),
        );
    }

    protected function imagesRelativePath(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->slider_relative_path
                . DS . config('images.directory'),
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

    protected function archiveRelativePath(): Attribute
    {
        return Attribute::make(
            get: fn () => config('archives.directory')
                . DS . StringHelper::trimExt($this->filename),
        );
    }

    protected function archiveAbsolutePath(): Attribute
    {
        return Attribute::make(
            get: fn () => storage_path('app'
                . DS . 'public'
                . DS . $this->archive_relative_path),
        );
    }
}
