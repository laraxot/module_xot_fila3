<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Illuminate\Support\Str;
use Modules\Xot\Contracts\PanelTreeContract;
use Modules\Xot\Relations\CustomRelation;
use Nwidart\Modules\Laravel\Module;

/**
 * Class PanelTreeService.
 */
class PanelTreeService {
    //esempio parametro stringa 'area-1-menu-1'
    //rilascia il pannello dell'ultimo container (nell'esempio menu),
    //con parent il pannello del precedente container (nell'esempio area)
    public static function getById(string $id): PanelTreeContract {
        $piece = explode('-', $id);
        $route_params = [];
        $j = 0;
        for ($i = 0; $i < count($piece); ++$i) {
            if (0 == $i % 2) {
                $route_params['container'.$j] = $piece[$i];
            } else {
                $route_params['item'.$j] = $piece[$i];
                ++$j;
            }
        }
        //[$containers, $items] = params2ContainerItem($route_params);
        //dddx([$route_params, $containers, $items]);
        $route_params['in_admin'] = true;

        return self::getByParams($route_params);
    }

    /**
     * Function getByParams.
     */
    public static function getByParams(?array $route_params): PanelTreeContract {
        [$containers, $items] = params2ContainerItem($route_params);
        $in_admin = null;
        if (isset($route_params['in_admin'])) {
            $in_admin = $route_params['in_admin'];
        }
        if (0 == count($containers)) {
            $panel = self::getHomePanel();

            return $panel;
        }
        $home_row = self::getHomePanel()->getRow();

        $first_container = $containers[0];

        $row = TenantService::model($containers[0]);

        $rows = new CustomRelation(
            $row->newQuery(),
            $home_row,
            function ($relation): void {
                $relation->getQuery();
            },
            null,
            null
        );

        $panel = PanelService::get($row);
        $panel->setRows($rows);
        $panel->setName($first_container);
        $i = 0;
        if (isset($items[0])) {
            $panel->setInAdmin($in_admin);
            $panel->setItem($items[0]);
        }
        $panel_parent = $panel;

        for ($i = 1; $i < count($containers); ++$i) {
            $row_prev = $panel_parent->getRow();
            $types = Str::camel($containers[$i]);
            $rows = $row_prev->{$types}();
            $row = $rows->getRelated();
            $panel = PanelService::get($row);
            //$rows = $rows->getQuery();
            $panel->setRows($rows);
            $panel->setName($types);
            $panel->setParent($panel_parent);

            if (isset($items[$i])) {
                $panel->setInAdmin($in_admin);
                $panel->setItem($items[$i]);
            }
            $panel_parent = $panel;
        }

        return $panel;
    }

    public static function getHomePanel(): PanelTreeContract {
        $home = TenantService::model('home');

        if (inAdmin()) {
            $params = getRouteParameters();
            $module = Module::find($params['module']);
            $panel = '\Modules\\'.$module->getName().'\Models\Panels\_ModulePanel';
            $panel = app($panel);
            $panel->setRow($home);
            $panel->setName('admin');
        } else {
            $panel = PanelService::get($home);
            $panel->setName('home');
        }

        /*->firstOrCreate(['id' => 1]);*/
        //$panel = PanelService::get($home);

        $rows = new CustomRelation(
            $home->newQuery(),
            $home,
            function ($relation): void {
                $relation->getQuery();
            },
            null,
            null
        );
        $panel->setRows($rows);

        return $panel;
    }
}
