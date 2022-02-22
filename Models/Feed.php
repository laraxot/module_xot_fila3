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
 * @method static \Illuminate\Database\Eloquent\Builder|Feed newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Feed newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Feed query()
 * @method static \Illuminate\Database\Eloquent\Builder|Feed whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feed wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feed whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $created_by
 * @property string|null $updated_by
 * @method static \Illuminate\Database\Eloquent\Builder|Feed whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feed whereUpdatedBy($value)
 * @property int $id
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Xot\Models\Image[] $images
 * @property-read int|null $images_count
 * @method static \Modules\Xot\Database\Factories\FeedFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Feed whereId($value)
 */
<<<<<<< HEAD
class Feed extends BaseModel {
=======
class Feed extends BaseModel
{
    protected $fillable=['id','created_by','updated_by','created_at','updated_at'];

>>>>>>> 05f4961 (.)
    /**
     * @var string[]
     */
    protected $fillable = ['id', 'created_at', 'updated_at'];
}