<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Modules\Theme\Services\ThemeService;
use Modules\Xot\Services\PanelService;

class ItemController extends XotBaseContainerController {
    /*
    public function myRoutes() {
        dddx(getRouteParameters());
    }

    public function index(Request $request) {
        $params = getRouteParameters();
        $panel = PanelService::getByParams($params);

        return $panel->out();
    }
    */
    public function index(Request $request) {
        $route_params = getRouteParameters(); // "module" => "lu"
        [$containers,$items] = params2ContainerItem();
        //dddx(['contianers' => $containers, 'items' => $items]);
        if (0 == count($containers)) {
            return $this->home($request);
        }
        if (count($containers) == count($items)) {
            return $this->show($request);
        }

        return $this->__call('index', $route_params);
    }

    public function home(Request $request) {
        $action = \Route::current()->getAction();
        $action['controller'] = 'Modules\Xot\Http\Controllers\ItemController@'.__FUNCTION__;
        $action = \Route::current()->setAction($action);
        $view = ThemeService::getView();
        $view_params = [
            'lang' => app()->getLocale(),
            'view' => $view,
        ];

        return view()->make($view, $view_params);
    }
}
