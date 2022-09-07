<?php

declare(strict_types=1);

namespace Modules\Xot\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

// ------ ext models---

/**
 * Modules\Xot\Models\Image.
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|Image[] $images
 * @property-read int|null $images_count
 * @property-read \Modules\LU\Models\User|null $user
 * @method static \Modules\Xot\Database\Factories\ImageFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image query()
 * @mixin \Eloquent
 */
class Image extends BaseModel {
    /**
     * @var string[]
     */
    protected $fillable = ['src', 'width', 'height', 'src_out'];

    public function user(): BelongsTo {
        $user_class = getUserClass();

        return $this->belongsTo($user_class);
    }
}