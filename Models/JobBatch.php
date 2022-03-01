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
 * @property string                                                               $name
 * @property int                                                                  $total_jobs
 * @property int                                                                  $pending_jobs
 * @property int                                                                  $failed_jobs
 * @property string                                                               $failed_job_ids
 * @property string|null                                                          $options
 * @property int|null                                                             $cancelled_at
 * @property \Illuminate\Support\Carbon                                           $created_at
 * @property int|null                                                             $finished_at
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\Xot\Models\Image[] $images
 * @property int|null                                                             $images_count
 * @method static \Modules\Xot\Database\Factories\JobBatchFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|JobBatch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JobBatch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JobBatch query()
 * @method static \Illuminate\Database\Eloquent\Builder|JobBatch whereCancelledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobBatch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobBatch whereFailedJobIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobBatch whereFailedJobs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobBatch whereFinishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobBatch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobBatch whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobBatch whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobBatch wherePendingJobs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobBatch whereTotalJobs($value)
 * @mixin \Eloquent
 * @mixin IdeHelperJobBatch
 */
class JobBatch extends BaseModel {
    protected $fillable = [
        'id',
        'name',
        'total_jobs',
        'pending_jobs',
        'failed_jobs',
        'failed_job_ids',
        'options',
        'cancelled_at',
        'created_at',
        'finished_at',
    ];
}
