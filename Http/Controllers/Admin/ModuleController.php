<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Tenant\Services\TenantService;
use Modules\Theme\Services\ThemeService;
use Modules\Xot\Relations\CustomRelation;
use Modules\Xot\Services\PanelService;
use Nwidart\Modules\Facades\Module;

/*
* gestisce i module
*/

// /*

/**
 * Class ModuleController.
 */
// class ModuleController extends XotBaseContainerController {
// }
// */
// *
class ModuleController extends Controller {
    /**
     * @return mixed
     */
    public function index(Request $request) {
        $panel = PanelService::make()->getRequestPanel();
        if (null == $panel) {
            throw new Exception('['.__LINE__.']['.__FILE__.']');
        }

        if ('' !== $request->_act && null != $panel) {
            // return $panel->callItemActionWithGate($request->_act);
            // return $panel->callContainerAction($request->_act);
            return $panel->callAction($request->_act);
        }

        return $panel->out();
        // dddx(ThemeService::getView());//progressioni::admin.index

        // return $panel->getView();
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

    /**
     * Undocumented function.
     *
     * @return mixed
     */
    public function home(Request $request) {
        $panel = PanelService::make()->getRequestPanel();
        if (null == $panel) {
            throw new Exception('['.__LINE__.']['.__FILE__.']');
        }
        $act = $request->input('_act', '');
        if ('' !== $act) {
            return $panel->callItemActionWithGate($act);
            // return $panel->callContainerAction($request->_act);
            // return $panel->callAction($request->_act);
        }

        return $panel->out();
    }

    /**
     * Undocumented function.
     *
     * @return mixed
     */
    public function dashboard(Request $request) {
        $panel = PanelService::make()->getRequestPanel();
        if (null == $panel) {
            throw new Exception('['.__LINE__.']['.__FILE__.']');
        }
        $act = $request->input('_act', '');
        if ('' !== $act) {
            return $panel->callItemActionWithGate($act);
            // return $panel->callContainerAction($request->_act);
            // return $panel->callAction($request->_act);
        }

        return $panel->out();
    }
}
// */