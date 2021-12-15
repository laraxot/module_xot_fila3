<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Modules\Xot\Contracts\PanelContract;
use Modules\Xot\Http\Requests\XotRequest;
use Modules\Xot\Services\PanelService;
use Modules\Xot\Services\PolicyService;

//---- services ---

/**
 * Class ItemController.
 */
class ContainersController extends Controller {
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

    public function __call($method, $args) {
        $action = \Route::current()->getAction();
        $action['controller'] = __CLASS__.'@'.$method;
        $action = \Route::current()->setAction($action);

        $this->panel = PanelService::getRequestPanel();
        if ('' != request()->input('_act', '')) {
            return $this->__callPanelAct($method, $args);
        }

        return $this->__callRouteAct($method, $args);
    }

    /**
     * @return mixed
     */
    public function __callRouteAct(string $method, array $args) {
        $panel = $this->panel;
        $authorized = Gate::allows($method, $panel);

        if (! $authorized) {
            //dddx($method, $panel);

            return $this->notAuthorized($method, $panel);
        }
        $request = XotRequest::capture();

        $controller = $this->getController();

        $panel = app($controller)->$method($request, $panel);

        return $panel;
    }

    /**
     * @return mixed
     */
    public function __callPanelAct(string $method, array $args) {
        $request = request();
        $act = $request->_act;
        $method_act = Str::camel($act);

        $panel = $this->panel;

        $authorized = Gate::allows($method_act, $panel);
        if (! $authorized) {
            return $this->notAuthorized($method_act, $panel);
        }

        return $panel->callAction($act);
    }

    /**
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function notAuthorized(string $method, PanelContract $panel) {
        $lang = app()->getLocale();

        if (! \Auth::check()) {
            $referer = \Request::path();

            return redirect()->route('login', ['lang' => $lang, 'referer' => $referer])
            ->withErrors(['active' => 'login before']);
        }
        $policy_class = PolicyService::get($panel)->createIfNotExists()->getClass();
        $msg = 'Auth Id ['.\Auth::id().'] not can ['.$method.'] on ['.$policy_class.']';

        return response()->view('pub_theme::errors.403', ['msg' => $msg], 403);
    }

    public function getController(): string {
        list($containers, $items) = params2ContainerItem();
        $mod_name = $this->panel->getModuleName(); //forse da mettere container0

        $tmp = collect($containers)->map(
            function ($item) {
                return Str::studly($item);
            }
        )->implode('\\');
        if ('' == $tmp) {
            $tmp = 'Module';
        }
        $controller = '\Modules\\'.$mod_name.'\Http\Controllers\Admin\\'.$tmp.'Controller';

        if (class_exists($controller)) {
            return $controller;
        }
        if ('Module' == $tmp) {
            return '\Modules\Xot\Http\Controllers\Admin\ModuleController';
        }

        return '\Modules\Xot\Http\Controllers\Admin\XotPanelController';
    }
}