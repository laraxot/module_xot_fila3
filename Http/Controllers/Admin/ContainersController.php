<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Controllers\Admin;

<<<<<<< HEAD
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
=======
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
>>>>>>> 9472ad4 (first)
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Modules\Xot\Contracts\PanelContract;
use Modules\Xot\Http\Requests\XotRequest;
<<<<<<< HEAD
use Modules\Xot\Services\FileService;
use Modules\Xot\Services\PanelService;
use Modules\Xot\Services\PolicyService;

// ---- services ---
=======
use Modules\Xot\Services\PanelService;
use Modules\Xot\Services\PolicyService;

//---- services ---
>>>>>>> 9472ad4 (first)

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
    public PanelContract $panel;

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
            $act = isset($route_params['module']) ? 'home' : 'dashboard';

            $res = $this->{$act}($request);

            return $res;
        }
        if (\count($containers) === \count($items)) {
            $res = $this->show($request);
            /*
            if ('Illuminate\View\View' == get_class($res)) {
               $res = $res->render();
            }

            xdebug_set_filter(
               XDEBUG_FILTER_TRACING,
               XDEBUG_PATH_EXCLUDE,
               [LARAVEL_DIR.'/vendor/']
            );
            xdebug_print_function_stack();
            */
            return $res;
        }

        $res = $this->__call('index', $route_params);

        return $res;
=======
    public function index(Request $request)
    {
        $route_params = getRouteParameters(); // "module" => "lu"
        [$containers,$items] = params2ContainerItem();
        //dddx(['contianers' => $containers, 'items' => $items]);
        if (0 == count($containers)) {
            $act = isset($route_params['module']) ? 'home' : 'dashboard';

            return $this->{$act}($request);
        }
        if (count($containers) == count($items)) {
            return $this->show($request);
        }

        return $this->__call('index', $route_params);
>>>>>>> 9472ad4 (first)
    }

    /**
     * Undocumented function.
     *
     * @param string $method
     * @param array  $args
     *
     * @return mixed
     */
<<<<<<< HEAD
    public function __call($method, $args) {
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
        $lang = app()->getLocale();

        if (! Auth::check()) {
=======
    public function notAuthorized(string $method, PanelContract $panel)
    {
        $lang = app()->getLocale();

        if (! \Auth::check()) {
>>>>>>> 9472ad4 (first)
            $referer = \Request::path();

            return redirect()->route('login', ['lang' => $lang, 'referer' => $referer])
                ->withErrors(['active' => 'login before']);
        }
        $policy_class = PolicyService::get($panel)->createIfNotExists()->getClass();
<<<<<<< HEAD
        $msg = 'Auth Id ['.Auth::id().'] not can ['.$method.'] on ['.$policy_class.']';
        FileService::viewCopy('theme::errors.403', 'pub_theme::errors.403');
=======
        $msg = 'Auth Id ['.\Auth::id().'] not can ['.$method.'] on ['.$policy_class.']';
>>>>>>> 9472ad4 (first)

        return response()->view('pub_theme::errors.403', ['msg' => $msg], 403);
    }

<<<<<<< HEAD
    /**
     * Undocumented function.
     */
    public function getController(): string {
        list($containers, $items) = params2ContainerItem();
        $mod_name = $this->panel->getModuleName(); // forse da mettere container0
=======
    public function getController(): string
    {
        list($containers, $items) = params2ContainerItem();
        $mod_name = $this->panel->getModuleName(); //forse da mettere container0
>>>>>>> 9472ad4 (first)

        $tmp = collect($containers)->map(
            function ($item) {
                return Str::studly($item);
            }
        )->implode('\\');
<<<<<<< HEAD
        if ('' === $tmp) {
=======
        if ('' == $tmp) {
>>>>>>> 9472ad4 (first)
            $tmp = 'Module';
        }
        $controller = '\Modules\\'.$mod_name.'\Http\Controllers\Admin\\'.$tmp.'Controller';

        if (class_exists($controller)) {
            return $controller;
        }
<<<<<<< HEAD
        if ('Module' === $tmp) {
=======
        if ('Module' == $tmp) {
>>>>>>> 9472ad4 (first)
            return '\Modules\Xot\Http\Controllers\Admin\ModuleController';
        }

        return '\Modules\Xot\Http\Controllers\Admin\XotPanelController';
    }
}
