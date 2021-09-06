<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
//---- services ---
use Modules\Theme\Services\ThemeService;
use Modules\Xot\Services\PanelService;
use Modules\Xot\Services\TenantService;
use Nwidart\Modules\Facades\Module;

//use Modules\Xot\Services\ArtisanService;

/**
 * Class HomeController.
 */
class HomeController extends Controller {
    /**
     * @return mixed
     */
    public function index(Request $request) {
        //$out = ArtisanService::act($request->act);
        //if ('' != $out) {
        //    return $out;
        //}
        //
        /*
        $home = TenantService::model('home');
        $panel = PanelService::get($home);

        return $panel->view(); //mi restituisce la index delle "homes"
        */
        $route_current = \Route::current();
        $params = [];
        if (null != $route_current) {
            $params = $route_current->parameters();
        }

        //dddx(PanelService::getRequestPanel());//null
        $module_name = collect($params)->get('module');
        $module = Module::find($module_name);
        if (! is_object($module)) {
            $data = ['message' => 'module ['.$module_name.'] is unknown '];

            return response()->view('adm_theme::errors.404', $data, 404);
        }
        //dddx(get_class_methods($module));
        //dddx($module->getName());
        $_panel = null;
        $home_panel_class = 'Modules\\'.$module->getName().'\Models\Panels\HomePanel';
        if (class_exists($home_panel_class)) {
            $_panel = app($home_panel_class);
        }

        $home_view = $module_name.'::admin.index';
        if (\View::exists($home_view)) {
            return ThemeService::view($home_view)->with('_panel', $_panel);
        }

        return ThemeService::view('xot::admin.home');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirect(Request $request) {
        return redirect($request->url);
    }
}
