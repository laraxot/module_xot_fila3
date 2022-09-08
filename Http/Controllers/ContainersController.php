<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Controllers;

use App\Http\Controllers\Controller;
<<<<<<< HEAD
use Exception;
=======
>>>>>>> 9472ad4 (first)
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Modules\Xot\Contracts\PanelContract;
use Modules\Xot\Http\Requests\XotRequest;
use Modules\Xot\Services\FileService;
use Modules\Xot\Services\PanelService;
use Modules\Xot\Services\PolicyService;

/**
 * Undocumented class.
 *
 * @method Renderable home(Request $request)
 * @method Renderable show(Request $request)
 */
<<<<<<< HEAD
class ContainersController extends Controller {
=======
class ContainersController extends Controller
{
>>>>>>> 9472ad4 (first)
    protected PanelContract $panel;

    /*
    public function myRoutes() {
        dddx(getRouteParameters());
    }

    public function index(Request $request) {
        $params = getRouteParameters();
        $panel = PanelService::make()->getByParams($params);

        return $panel->out();
    }
    */
    /**
     * Undocumented function.
     *
     * @return mixed
     */
<<<<<<< HEAD
    public function index(Request $request) {
        $route_params = getRouteParameters(); // "module" => "lu"
        [$containers,$items] = params2ContainerItem();
        // dddx(['contianers' => $containers, 'items' => $items]);
        if (0 === \count($containers)) {
            return $this->home($request);
        }
        if (\count($containers) === \count($items)) {
=======
    public function index(Request $request)
    {
        $route_params = getRouteParameters(); // "module" => "lu"
        [$containers,$items] = params2ContainerItem();
        //dddx(['contianers' => $containers, 'items' => $items]);
        if (0 == count($containers)) {
            return $this->home($request);
        }
        if (count($containers) == count($items)) {
>>>>>>> 9472ad4 (first)
            return $this->show($request);
        }

        return $this->__call('index', $route_params);
    }

<<<<<<< HEAD
    public function __call($method, $args) {
        // dddx(['method' => $method, 'args' => $args]);
        $route_current = \Route::current();
        if (null != $route_current) {
            /**
             * @var array
             */
            $action = $route_current->getAction();
            $action['controller'] = __CLASS__.'@'.$method;
            $action = $route_current->setAction($action);
        }
        $panel = PanelService::make()->getRequestPanel();
        if (null == $panel) {
            throw new Exception('['.__LINE__.']['.__FILE__.']');
        }
        $this->panel = $panel;

        if ('' !== request()->input('_act', '')) {
=======
    public function __call($method, $args)
    {
        $action = \Route::current()->getAction();
        $action['controller'] = __CLASS__.'@'.$method;
        $action = \Route::current()->setAction($action);

        $this->panel = PanelService::make()->getRequestPanel();

        if ('' != request()->input('_act', '')) {
>>>>>>> 9472ad4 (first)
            return $this->__callPanelAct($method, $args);
        }

        return $this->__callRouteAct($method, $args);
    }

<<<<<<< HEAD
    public function getController(): string {
=======
    public function getController(): string
    {
>>>>>>> 9472ad4 (first)
        /*
        if (null == $this->panel) {
            return '\Modules\Xot\Http\Controllers\XotPanelController';
        }
        */
        list($containers, $items) = params2ContainerItem();

        $mod_name = $this->panel->getModuleName();

        $tmp = collect($containers)->map(
            function ($item) {
                return Str::studly($item);
            }
        )->implode('\\');
        $controller = '\Modules\\'.$mod_name.'\Http\Controllers\\'.$tmp.'Controller';
<<<<<<< HEAD
        if (class_exists($controller) && '' !== $tmp) {
=======
        if (class_exists($controller) && '' != $tmp) {
>>>>>>> 9472ad4 (first)
            return $controller;
        }

        return '\Modules\Xot\Http\Controllers\XotPanelController';
    }

    /**
     * @return mixed
     */
<<<<<<< HEAD
    public function __callRouteAct(string $method, array $args) {
=======
    public function __callRouteAct(string $method, array $args)
    {
>>>>>>> 9472ad4 (first)
        $panel = $this->panel;
        $authorized = Gate::allows($method, $panel);

        if (! $authorized) {
<<<<<<< HEAD
            // dddx($method, $panel);
=======
            //dddx($method, $panel);
>>>>>>> 9472ad4 (first)

            return $this->notAuthorized($method, $panel);
        }
        $request = XotRequest::capture();

        $controller = $this->getController();
<<<<<<< HEAD
        // dddx([$controller, $method]);
        // Modules\Xot\Http\Controllers\XotPanelController
        // home
=======
>>>>>>> 9472ad4 (first)

        $panel = app($controller)->$method($request, $panel);

        return $panel;
    }

    /**
     * @return mixed
     */
<<<<<<< HEAD
    public function __callPanelAct(string $method, array $args) {
        $request = request();
        /**
         * @var string
         */
=======
    public function __callPanelAct(string $method, array $args)
    {
        $request = request();
>>>>>>> 9472ad4 (first)
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
<<<<<<< HEAD
    public function notAuthorized(string $method, PanelContract $panel) {
=======
    public function notAuthorized(string $method, PanelContract $panel)
    {
>>>>>>> 9472ad4 (first)
        $lang = app()->getLocale();
        /*
        if (! \Auth::check()) {
            $referer = \Request::path();

            return redirect()->route('login', ['lang' => $lang, 'referer' => $referer])
            ->withErrors(['active' => 'login before']);
        }
        */
        $policy_class = PolicyService::get($panel)->createIfNotExists()->getClass();
        $msg = 'Auth Id ['.\Auth::id().'] not can ['.$method.'] on ['.$policy_class.']';

<<<<<<< HEAD
        // $msg = 'Auth Id ['.\Auth::id().'] not can ['.$method.'] on ['.get_class($panel).']';
=======
        //$msg = 'Auth Id ['.\Auth::id().'] not can ['.$method.'] on ['.get_class($panel).']';
>>>>>>> 9472ad4 (first)
        FileService::viewCopy('theme::errors.403', 'pub_theme::errors.403');

        return response()->view('pub_theme::errors.403', ['msg' => $msg], 403);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 9472ad4 (first)
