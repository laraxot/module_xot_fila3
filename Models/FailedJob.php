<?php
/**
 * ---.
 */

declare(strict_types=1);

namespace Modules\Xot\Models;

/**
 * @mixin IdeHelperFailedJob
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