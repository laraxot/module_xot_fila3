<?php

declare(strict_types=1);

namespace Modules\Xot\Models;

// --- services

// --- TRAITS ---

/**
 * Modules\Xot\Models\Feed.
 *
 * @property int                             $post_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Modules\Xot\Database\Factories\FeedFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Feed  newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Feed  newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Feed  query()
 * @method static \Illuminate\Database\Eloquent\Builder|Feed  whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feed  wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feed  whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Feed extends BaseModel {
    /**
     * @var string[]
     */
    protected $fillable = ['id', 'created_at', 'updated_at'];
}
