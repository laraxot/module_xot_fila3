<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Controllers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
//---- services ---

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Schema;
use Modules\Theme\Services\ThemeService;
use Modules\Xot\Contracts\PanelContract;
use Modules\Xot\Relations\CustomRelation;
use Modules\Xot\Services\PanelService;
use Modules\Xot\Services\PanelService as Panel;
use Modules\Xot\Services\TenantService as Tenant;

/**
 * Class HomeController.
 */
class HomeController extends Controller {
    /**
     * @return mixed
     */
    //public function index(?array $data, $panel = null) {
    public function index(Request $request, ?PanelContract $panel = null) {
        $request = request();
        $home = null;
        try {
            $model = Tenant::modelEager('home');
            $home = $model->firstOrCreate(['id' => 1]);
        } catch (\Exception $e) {
            dddx('run migrations');
        }
        if (null == $home) {
            throw new \Exception('home is null');
        }

        $home_panel = Panel::get($home);

        if ('' != $request->_act) {
            return $home_panel->callItemActionWithGate($request->_act);
        }

        return ThemeService::view('pub_theme::home.index')
            ->with('home', $home)
            ->with('_panel', $home_panel)
            ;
    }

    public function createHomesTable(): void {
        Schema::create('homes', function (Blueprint $table): void {
            $table->increments('id');

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * @return mixed
     */
    //public function show(?array $data, $panel=null) {
    public function show(Request $request, ?PanelContract $panel = null) {
        $panel = PanelService::getRequestPanel();
        if ('' != $request->_act) {
            return $panel->callItemActionWithGate($request->_act);
        }

        return $panel->out();
    }

    public function showOld(Request $request, ?PanelContract $panel = null) {
        //$request=request();
        $home = null;
        $home = Tenant::model('home');
        $mod_name = Panel::get($home)->getModuleName();

        $home_controller = '\Modules\\'.$mod_name.'\Http\Controllers\HomeController';

        //dddx($home_controller);

        if ('' != $request->_act) {
            $home = Tenant::model('home');
            $panel = Panel::get($home);

            return $panel->callItemActionWithGate($request->_act);
        }

        if (class_exists($home_controller) && 'Xot' != $mod_name) {
            return app($home_controller)->show($request);
        }

        try {
            $home = Tenant::modelEager('home');
            $home = $home->firstOrCreate(['id' => 1]);
        } catch (\Exception $e) {
            dddx(['exception' => $e, 'model' => $home]);
        }
        $panel = Panel::get($home);

        $rows = new CustomRelation(
            $home->newQuery(),
            $home,
            function ($relation): void {
                $relation->getQuery();
            },
            null,
            null
        );
        $panel->setRows($rows);

        return $panel->out();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirect(Request $request) {
        return redirect($request->url);
    }
}
