<?php

namespace App\Models;

use App\Helpers\StringHelper;
use App\Services\DocumentService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property string $filename
 * @property string $type
 * @property int $size
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Image> $images
 * @property-read int|null $images_count
 * @property-read mixed $file_relative_path
 * @property-read mixed $filepath
 * @property-read mixed $images_absolute_path
 * @property-read mixed $images_relative_path
 * @property-read mixed $slider_absolute_path
 * @property-read mixed $slider_archive_absolute_path
 * @property-read mixed $slider_archive_relative_path
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
 * @mixin \Eloquent
 */
class Document extends Model
{
    use Prunable;

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

    public function prunable(): Builder
    {
        return static::where('created_at', '<', now()->subDay());
    }

    protected function pruning(): void
    {
        $this->getDocumentService()->deleteDocumentFiles($this);
    }

    protected function getDocumentService(): DocumentService
    {
        return app(DocumentService::class);
    }

    protected function fileRelativePath(): Attribute
    {
        return Attribute::make(
            get: fn (): string => config('documents.directory')
                . DS . $this->filename,
        );
    }

    protected function filepath(): Attribute
    {
        return Attribute::make(
            get: fn (): string => storage_path(
                'app'
                . DS . 'private'
                . DS . $this->file_relative_path,
            ),
        );
    }

    protected function sliderRelativePath(): Attribute
    {
        return Attribute::make(
            get: fn (): string => config('sliders.directory')
                . DS . StringHelper::trimExt($this->filename),
        );
    }

    protected function sliderAbsolutePath(): Attribute
    {
        return Attribute::make(
            get: fn (): string => storage_path('app'
                . DS . 'public'
                . DS . $this->slider_relative_path),
        );
    }

    protected function imagesRelativePath(): Attribute
    {
        return Attribute::make(
            get: fn (): string => $this->slider_relative_path
                . DS . config('images.directory'),
        );
    }

    protected function imagesAbsolutePath(): Attribute
    {
        return Attribute::make(
            get: fn (): string => storage_path(
                'app'
                . DS . 'public'
                . DS . $this->images_relative_path,
            ),
        );
    }

    protected function sliderArchiveRelativePath(): Attribute
    {
        return Attribute::make(
            get: fn (): string => config('archives.directory')
                . DS . StringHelper::trimExt($this->filename),
        );
    }

    protected function sliderArchiveAbsolutePath(): Attribute
    {
        return Attribute::make(
            get: fn (): string => storage_path('app'
                . DS . 'public'
                . DS . $this->slider_archive_relative_path),
        );
    }
}
