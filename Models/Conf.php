<?php

declare(strict_types=1);

namespace Modules\Xot\Models;

use Modules\Tenant\Services\TenantService;
use Sushi\Sushi;

class Conf extends BaseModel {
    use Sushi;

    /**
     * @var string[]
     */
    public $fillable = [
        'id', 'name',
    ];

    public function getRows() {
        return TenantService::getConfigNames(); //  local/ptvx
    }

    /*
    protected function sushiShouldCache() {
        return false;
    }
    */
    public function getRouteKeyName() {
        return 'name';
    }
}