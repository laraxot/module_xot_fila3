<?php
/**
 * ---.
 */

declare(strict_types=1);

namespace Modules\Xot\Models;

/**
 * Modules\Xot\Models\FailedJob.
 *
 * @property int                                                                  $id
<<<<<<< HEAD
=======
 * @property string                                                               $uuid
>>>>>>> d34c029 (up)
 * @property string                                                               $connection
 * @property string                                                               $queue
 * @property string                                                               $payload
 * @property string                                                               $exception
 * @property string                                                               $failed_at
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\Xot\Models\Image[] $images
 * @property int|null                                                             $images_count
 *
 * @method static \Modules\Xot\Database\Factories\FailedJobFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|FailedJob  newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FailedJob  newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FailedJob  query()
 * @method static \Illuminate\Database\Eloquent\Builder|FailedJob  whereConnection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FailedJob  whereException($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FailedJob  whereFailedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FailedJob  whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FailedJob  wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FailedJob  whereQueue($value)
<<<<<<< HEAD
=======
 * @method static \Illuminate\Database\Eloquent\Builder|FailedJob  whereUuid($value)
>>>>>>> d34c029 (up)
 *
 * @mixin \Eloquent
 */
class FailedJob extends BaseModel {
    protected $fillable = [
        'id',
        'uuid',
        'connection',
        'queue',
        'payload',
        'exception',
        'failed_at',
    ];
}
