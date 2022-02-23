<?php
/**
 * ---.
 */

declare(strict_types=1);

namespace Modules\Xot\Models;

/**
 * Undocumented class.
 *
 * @property int                                                                  $id
 * @property string                                                               $queue
 * @property string                                                               $payload
 * @property int                                                                  $attempts
 * @property int|null                                                             $reserved_at
 * @property int                                                                  $available_at
 * @property \Illuminate\Support\Carbon                                           $created_at
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\Xot\Models\Image[] $images
 * @property int|null                                                             $images_count
 * @method static \Modules\Xot\Database\Factories\JobFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Job newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Job newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Job query()
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereAttempts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereAvailableAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereQueue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereReservedAt($value)
 * @mixin \Eloquent
 */
class Job extends BaseModel {
    protected $fillable = [
        'id',
        'queue',
        'payload',
        'attempts',
        'reserved_at',
        'available_at',
        'created_at',
    ];
}
