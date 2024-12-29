<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Image
 *
 * @property int $id
 * @property int $document_id
 * @property string $filename
 * @property string $type
 * @property int $size
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Document $document
 * @method static Builder<static>|Image newModelQuery()
 * @method static Builder<static>|Image newQuery()
 * @method static Builder<static>|Image query()
 * @method static Builder<static>|Image whereCreatedAt($value)
 * @method static Builder<static>|Image whereDocumentId($value)
 * @method static Builder<static>|Image whereFilename($value)
 * @method static Builder<static>|Image whereId($value)
 * @method static Builder<static>|Image whereSize($value)
 * @method static Builder<static>|Image whereType($value)
 * @method static Builder<static>|Image whereUpdatedAt($value)
 */
class Image extends Model
{
    protected $fillable = [
        'filename',
        'type',
        'size',
    ];

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }
}
