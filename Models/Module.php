<?php

declare(strict_types=1);

namespace Modules\Xot\Models;

use Nwidart\Modules\Facades\Module as NwModule;
use Sushi\Sushi;

class Module extends BaseModel {
    use Sushi;

    /**
     * @var string[]
     */
    public $fillable = [
        'id', 'name',
    ];

    public function getRows(): array {
        $modules = NwModule::all();
        $rows = [];
        $i = 1;
        foreach ($modules as $k => $module) {
            $tmp = [
                'id' => $i++,
                'name' => $module->getName(),
            ];
            $rows[] = $tmp;
        }

        return $rows;
    }

    /**
     * Undocumented function.
     *
     * @return string
     */
    public function getRouteKeyName() {
        return 'id';
    }
}
