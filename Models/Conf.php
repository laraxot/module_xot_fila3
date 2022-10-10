<?php

declare(strict_types=1);

namespace Modules\Xot\Models;

use Modules\Tenant\Services\TenantService;
use Sushi\Sushi;

/**
 * Modules\Xot\Models\Conf
 *
 * @property int $id
 * @property string|null $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Xot\Models\Image[] $images
 * @property-read int|null $images_count
 * @method static \Modules\Xot\Database\Factories\ConfFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Conf newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Conf newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Conf query()
 * @method static \Illuminate\Database\Eloquent\Builder|Conf whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conf whereName($value)
 * @mixin \Eloquent
 */
class Conf extends BaseModel
{
    use Sushi;

    /**
     * @var string[]
     */
    public $fillable = [
        'id', 'name',
    ];

    public function getRows(): array
    {
        return TenantService::getConfigNames(); //  local/ptvx
    }

    /*
    protected function sushiShouldCache() {
        return false;
    }
    */

    /**
     * Undocumented function.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }
}
