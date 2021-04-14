<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Illuminate\Support\Collection;
use Modules\Xot\Contracts\PanelContract;

class TreeService {
    public static function mapItems(Collection $coll, ?PanelContract $parent = null) {
        return $coll->map(
                function ($item) use ($parent) {
                    $panel = PanelService::get($item)->setParent($parent);

                    return  [
                        'id' => $panel->id(),
                        'title' => $panel->title(),
                        'acts' => [
                            [
                                'title' => 'modifica',
                                'url' => '/admin/product_cat/5/edit',
                            ],
                            [
                                'title' => 'guarda',
                                'url' => '/admin/product_cat/5',
                            ],
                        ],
                    ];
                }
            );
    }
}
