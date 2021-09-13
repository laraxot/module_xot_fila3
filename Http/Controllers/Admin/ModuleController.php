<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Theme\Services\ThemeService;
use Modules\Xot\Relations\CustomRelation;
use Modules\Xot\Services\PanelService;
use Modules\Xot\Services\TenantService;
use Nwidart\Modules\Facades\Module;

/*
* gestisce i module
*/

///*

/**
 * Class ModuleController.
 */
//class ModuleController extends XotBaseContainerController {
//}
//*/
//*
class ModuleController extends Controller {
    /**
     * @return mixed
     */
    public function index(Request $request) {
        $panel = PanelService::getRequestPanel();

        if ('' != $request->_act) {
            return $panel->callItemActionWithGate($request->_act);
        }

        return $panel->out();
        //dddx(ThemeService::getView());//progressioni::admin.index

        //return $panel->getView();
        /*
        $params = optional(\Route::current())->parameters();

        $home_view = $params['module'].'::admin.index';

        if ('' != $request->_act) {
            $module = Module::find($params['module']);

            $panel = '\Modules\\'.$module->getName().'\Models\Panels\HomePanel';

            $panel = app($panel);

            $home = TenantService::model('home');

            $rows = new CustomRelation(
                $home->newQuery(),
                $home,
                function ($relation): void {
                    $relation->getQuery();
                },
                null,
                null
            );

            $panel->setName('home');
            $panel->setRows($rows);

            return $panel->callItemActionWithGate($request->_act);
        }

        if (\View::exists($home_view)) {
            return view()->make($home_view);
        }

        return ThemeService::view('xot::admin.home');
        */
    }

    /**
     * Undocumented function.
     *
     * @return mixed
     */
    public function store(Request $request) {
        return $this->index($request);
        /*
        $params = optional(\Route::current())->parameters();

        $home_view = $params['module'].'::admin.index';

        if ('' != $request->_act) {
            $module = Module::find($params['module']);

            $panel = '\Modules\\'.$module->getName().'\Models\Panels\HomePanel';

            $panel = app($panel);

            $home = TenantService::model('home');

            $rows = new CustomRelation(
                $home->newQuery(),
                $home,
                function ($relation): void {
                    $relation->getQuery();
                },
                null,
                null
            );

            $panel->setName('home');
            $panel->setRows($rows);

            return $panel->callItemActionWithGate($request->_act);
        }

        if (\View::exists($home_view)) {
            return view()->make($home_view);
        }

        return ThemeService::view('xot::admin.home');
        */
    }
}
//*/