<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
<<<<<<< HEAD
// --- services ---
=======
//--- services ---
>>>>>>> 9472ad4 (first)
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Modules\Xot\Contracts\PanelContract;
use Modules\Xot\Http\Requests\XotRequest;
use Modules\Xot\Services\PanelService;
use Modules\Xot\Services\PolicyService;

/**
 * Class XotBaseContainerController.
 */
<<<<<<< HEAD
abstract class XotBaseContainerController extends Controller {
=======
abstract class XotBaseContainerController extends Controller
{
>>>>>>> 9472ad4 (first)
    protected PanelContract $panel;

    /**
     * @param string $method
     * @param array  $args
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|mixed
     */
<<<<<<< HEAD
    public function __call($method, $args) {
        $panel = PanelService::make()->getRequestPanel();
        if (null === $panel) {
=======
    public function __call($method, $args)
    {
        $panel = PanelService::make()->getRequestPanel();
        if (null == $panel) {
>>>>>>> 9472ad4 (first)
            throw new \Exception('uston gavemo un problemon');
        }
        $this->panel = $panel;

<<<<<<< HEAD
        if ('' !== request()->input('_act', '')) {
=======
        if ('' != request()->input('_act', '')) {
>>>>>>> 9472ad4 (first)
            return $this->__callPanelAct($method, $args);
        }

        return $this->__callRouteAct($method, $args);
    }

<<<<<<< HEAD
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

    /**
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
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
            return $this->notAuthorized($method, $panel);
        }

        $request = XotRequest::capture();
        $controller = $this->getController();
<<<<<<< HEAD
        // $data = $request->all();
=======
        //$data = $request->all();
>>>>>>> 9472ad4 (first)

        $out = app($controller)->$method($request, $panel);

        return $out;
    }

    /**
     * @param string $method
     * @param array  $args
     *
<<<<<<< HEAD
     * return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     * @return mixed
     */
    public function __callPanelAct($method, $args) {
        $request = request();
        /**
         * @var string
         */
=======
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function __callPanelAct($method, $args)
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
        if (! \Auth::check()) {
            // $request = \Modules\Xot\Http\Requests\XotRequest::capture();
=======
    public function notAuthorized(string $method, PanelContract $panel)
    {
        $lang = app()->getLocale();
        if (! \Auth::check()) {
            //$request = \Modules\Xot\Http\Requests\XotRequest::capture();
>>>>>>> 9472ad4 (first)
            /*
            $request = request();
            if ($request->ajax()) {
                $html = '<h3>Before Login </h3>
            <button class="btn btn-social btn-facebook" onclick="location.href=\''.url($lang.'/login/facebook').'\'">
                <i class="fab fa-facebook-square fa-3x  "></i>
            </button>';
                $msg = ['msg' => 'ok', 'html' => $html];

                return response()->json($msg, 200);
            }

            $referer = \Request::path();

            return redirect()->route('login', ['lang' => $lang, 'referer' => $referer])
                ->withErrors(['active' => 'login before']);
            */
            $referer = \Request::path();

            return redirect()->route('login', ['lang' => $lang, 'referer' => $referer])
                ->withErrors(['active' => 'login before']);
        }
        $policy_class = PolicyService::get($panel)->createIfNotExists()->getClass();
        $msg = 'Auth Id ['.\Auth::id().'] not can ['.$method.'] on ['.$policy_class.']';

        return response()->view('pub_theme::errors.403', ['msg' => $msg, 'exception' => new \Exception($msg)], 403);
<<<<<<< HEAD
        // return view()->first(['pub_theme::errors.403','theme::errors.403'], ['msg' => $msg,'exception'=>new \Exception($msg)], 403);
    }
}
=======
        //return view()->first(['pub_theme::errors.403','theme::errors.403'], ['msg' => $msg,'exception'=>new \Exception($msg)], 403);
    }
}
>>>>>>> 9472ad4 (first)
