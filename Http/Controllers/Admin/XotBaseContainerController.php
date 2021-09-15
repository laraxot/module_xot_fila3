<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
//--- services ---
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Modules\Xot\Contracts\PanelContract;
use Modules\Xot\Http\Requests\XotRequest;
use Modules\Xot\Services\PanelService as Panel;
use Modules\Xot\Services\PolicyService;

/**
 * Class XotBaseContainerController.
 */
abstract class XotBaseContainerController extends Controller {
    protected PanelContract $panel;

    /**
     * @param string $method
     * @param array  $args
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|mixed
     */
    public function __call($method, $args) {
        $panel = Panel::getRequestPanel();
        if (null == $panel) {
            throw new \Exception('uston gavemo un problemon');
        }
        $this->panel = $panel;

        if ('' != request()->input('_act', '')) {
            return $this->__callPanelAct($method, $args);
        }

        return $this->__callRouteAct($method, $args);
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

    /**
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function __callRouteAct(string $method, array $args) {
        $panel = $this->panel;

        $authorized = Gate::allows($method, $panel);

        if (! $authorized) {
            return $this->notAuthorized($method, $panel);
        }

        $request = XotRequest::capture();
        $controller = $this->getController();
        //$data = $request->all();

        $out = app($controller)->$method($request, $panel);

        return $out;
    }

    /**
     * @param string $method
     * @param array  $args
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function __callPanelAct($method, $args) {
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
            //$request = \Modules\Xot\Http\Requests\XotRequest::capture();
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

            return redirect()->route('login.notice', ['lang' => $lang, 'referer' => $referer])
                ->withErrors(['active' => 'login before']);
            */
            $referer = \Request::path();

            return redirect()->route('login', ['lang' => $lang, 'referer' => $referer])
                ->withErrors(['active' => 'login before']);
        }
        $policy_class = PolicyService::get($panel)->createIfNotExists()->getClass();
        $msg = 'Auth Id ['.\Auth::id().'] not can ['.$method.'] on ['.$policy_class.']';

        return response()->view('pub_theme::errors.403', ['msg' => $msg, 'exception' => new \Exception($msg)], 403);
        //return view()->first(['pub_theme::errors.403','theme::errors.403'], ['msg' => $msg,'exception'=>new \Exception($msg)], 403);
    }
}