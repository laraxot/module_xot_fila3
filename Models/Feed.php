<?php

declare(strict_types=1);

namespace Modules\Xot\Models;

//--- services

//--- TRAITS ---

/**
 * Modules\Blog\Models\Feed.
 *
 * @property int                             $post_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Feed newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Feed newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Feed query()
 * @method static \Illuminate\Database\Eloquent\Builder|Feed whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feed wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feed whereUpdatedAt($value)
 * @mixin \Eloquent
 *
 * @property string|null $created_by
 * @property string|null $updated_by
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Feed whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feed whereUpdatedBy($value)
 */
class Feed extends BaseModel {
    /**
     * @var string[]
     */
    protected $fillable = ['id'];
}
