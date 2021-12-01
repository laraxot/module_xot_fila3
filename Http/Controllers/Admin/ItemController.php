<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Modules\Xot\Services\PanelService;

//---- services ---

/**
 * Class ItemController.
 */
class ItemController extends XotBaseContainerController {
    /*
    public function index(Request $request) {
        $route_params = getRouteParameters(); // "module" => "lu"
        [$containers,$items] = params2ContainerItem();
        //dddx(['contianers' => $containers, 'items' => $items]);
        if (0 == count($containers)) {
            return $this->module();
        }
        if (count($containers) == count($items)) {
            return $this->show($request);
        }

        return $this->__call('index', $route_params);
    }

    public function edit(Request $request, ...$args) {
        $route_params = getRouteParameters();
        [$containers,$items] = params2ContainerItem();
        if (count($containers) > count($items)) {
            return $this->indexEdit($request);
        }

        return $this->__call('edit', $route_params);
    }


    public function __call($method, $arg) {

        $action = \Route::current()->getAction();
        $action['controller'] = 'Modules\Xot\Http\Controllers\Admin\ItemController@'.$method;
        $action = \Route::current()->setAction($action);

        $panel = PanelService::getRequestPanel();
        $data = request()->all();

        $func = '\Modules\Xot\Jobs\PanelCrud\\'.Str::studly($method).'Job';
        $panel = $func::dispatchNow($data, $panel);

        return $panel->out();
    }
    */
}