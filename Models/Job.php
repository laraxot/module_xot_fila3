<?php
<<<<<<< HEAD
=======
/**
 * ---.
 */
>>>>>>> ae3a261 (up)

declare(strict_types=1);

namespace Modules\Xot\Models;

/**
<<<<<<< HEAD
 * Modules\Xot\Models\Job.
=======
 * Undocumented class.
>>>>>>> ae3a261 (up)
 *
 * @property int                                                                  $id
 * @property string                                                               $queue
 * @property string                                                               $payload
 * @property int                                                                  $attempts
 * @property int|null                                                             $reserved_at
 * @property int                                                                  $available_at
 * @property \Illuminate\Support\Carbon                                           $created_at
<<<<<<< HEAD
 * @property string|null                                                          $created_by
 * @property string|null                                                          $updated_by
 * @property \Illuminate\Support\Carbon|null                                      $updated_at
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\Xot\Models\Image[] $images
 * @property int|null                                                             $images_count
 *
 * @method static \Modules\Xot\Database\Factories\JobFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Job  newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Job  newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Job  query()
 * @method static \Illuminate\Database\Eloquent\Builder|Job  whereAttempts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job  whereAvailableAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job  whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job  whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job  whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job  wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job  whereQueue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job  whereReservedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job  whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job  whereUpdatedBy($value)
 *
 * @mixin \Eloquent
 */
class Job extends BaseModel {
    protected $fillable = ['id', 'queue', 'payload', 'attempts', 'reserved_at', 'available_at', 'created_at'];
=======
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
 * @mixin IdeHelperJob
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
>>>>>>> ae3a261 (up)
}
