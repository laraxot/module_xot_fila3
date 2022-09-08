<?php

declare(strict_types=1);

namespace Modules\Xot\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Xot\Models\Settings
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Settings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings query()
 * @mixin \Eloquent
 */
class Settings extends Model {
    /**
     * @var string[]
     */
    public $fillable = [
        'id', 'appname', 'description', 'keywords', 'author',
    ];
}
