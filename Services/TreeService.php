<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Illuminate\Support\Collection;
use Modules\Xot\Contracts\PanelContract;

class TreeService {
    public static function mapItems(Collection $coll, ?PanelContract $parent = null, bool $in_admin, array $route_params = null) {
        return $coll->map(
                function ($item) use ($parent,$in_admin, $route_params) {
                    $panel = PanelService::get($item)->setParent($parent);
                    $panel->setInAdmin(true);
                    $panel->setRouteParams($route_params);
                    $acts = [
                        [
                            'title' => 'modifica',
                            //'url' => '/admin/product_cat/5/edit',
                            'url' => $panel->url(['act' => 'edit']),
                        ],
                    ];
                    /*
                    foreach ($panel->itemActions() as $action) {
                        //$action->btnHtml(['title' => true, 'class' => 'dropdown-item','in_admin'=>$in_admin])
                        $act = [
                            'title' => $action->getTitle(),
                            'url' => $action->getUrl(),
                        ];
                        $acts[] = $act;
                    }
                    */

                    return  [
                        'id' => $panel->id(),
                        'title' => $panel->title(),
                        'acts' => $acts,
                    ];
                }
            );
    }
}
