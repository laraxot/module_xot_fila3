<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Modules\Theme\Services\ThemeService;
use Modules\Xot\Contracts\PanelContract;
use Modules\Xot\Services\PanelService;

class ContainersController extends XotBaseContainerController {
    protected PanelContract $panel;

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

    /*
    public function home(Request $request) {
        $action = \Route::current()->getAction();
        $action['controller'] = __CLASS__.'@'.__FUNCTION__;
        $action = \Route::current()->setAction($action);
        $view = ThemeService::getView();
        $view_params = [
            'lang' => app()->getLocale(),
            'view' => $view,
        ];

        return view()->make($view, $view_params);
    }
    */

    public function __call($method, $args) {
        $action = \Route::current()->getAction();
        $action['controller'] = __CLASS__.'@'.$method;
        $action = \Route::current()->setAction($action);

        $this->panel = PanelService::getRequestPanel();
        if ('' != request()->input('_act', '')) {
            return $this->__callPanelAct($method, $args);
        }

        return $this->__callRouteAct($method, $args);

        /*
        $data = request()->all();

        $func = '\Modules\Xot\Jobs\PanelCrud\\'.Str::studly($method).'Job';
        $panel = $func::dispatchNow($data, $panel);

        return $panel->out();
        */
    }
}
