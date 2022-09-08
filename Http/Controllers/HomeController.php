<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Controllers;

<<<<<<< HEAD
use Exception;
use Illuminate\Database\Schema\Blueprint;
// ---- services ---

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Schema;
use Modules\Tenant\Services\TenantService;
use Modules\Xot\Contracts\PanelContract;
=======
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
//---- services ---

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Schema;
use Modules\Tenant\Services\TenantService;
use Modules\Theme\Services\ThemeService;
use Modules\Xot\Contracts\PanelContract;
use Modules\Xot\Relations\CustomRelation;
>>>>>>> 9472ad4 (first)
use Modules\Xot\Services\PanelService;

/**
 * Class HomeController.
 */
class HomeController extends Controller {
    /**
     * @return mixed
     */
    public function index(Request $request, ?PanelContract $panel = null) {
        $request = request();
        $home = null;
        try {
<<<<<<< HEAD
            // $model = TenantService::modelEager('home');
            $model = getModelByName('home');
=======
            $model = TenantService::modelEager('home');
>>>>>>> 9472ad4 (first)
            $home = $model->firstOrCreate(['id' => 1]);
        } catch (\Exception $e) {
            dddx('run migrations');
        }
<<<<<<< HEAD
        if (null === $home) {
=======
        if (null == $home) {
>>>>>>> 9472ad4 (first)
            throw new \Exception('home is null');
        }

        $home_panel = PanelService::make()->get($home);
<<<<<<< HEAD
        /**
         * @var string
         */
        $act = $request->_act;

        if ('' !== $act) {
            return $home_panel->callItemActionWithGate($act);
        }
        $view = 'pub_theme::home.index';

        $view_params = [
            'home' => $home,
            '_panel' => $home_panel,
        ];
        /*
        return ThemeService::view('pub_theme::home.index')
            ->with('home', $home)
            ->with('_panel', $home_panel);
        */
        return view()->make($view, $view_params);
=======

        if ('' != $request->_act) {
            return $home_panel->callItemActionWithGate($request->_act);
        }

        return ThemeService::view('pub_theme::home.index')
            ->with('home', $home)
            ->with('_panel', $home_panel);
>>>>>>> 9472ad4 (first)
    }

    public function createHomesTable(): void {
        Schema::create(
            'homes',
            function (Blueprint $table): void {
                $table->increments('id');

                $table->string('created_by')->nullable();
                $table->string('updated_by')->nullable();
                $table->string('deleted_by')->nullable();
                $table->timestamps();
            }
        );
    }

    /**
     * @return mixed
     */
<<<<<<< HEAD
    // public function show(?array $data, $panel=null) {
    public function show(Request $request, ?PanelContract $panel = null) {
        // backtrace(true);
        $panel = PanelService::make()->getRequestPanel();
        if (null == $panel) {
            throw new Exception('['.__LINE__.']['.__FILE__.']');
        }
        /**
         * @var string
         */
        $act = $request->_act;
        if ('' !== $act) {
            return $panel->callItemActionWithGate($act);
        }

=======
    //public function show(?array $data, $panel=null) {
    public function show(Request $request, ?PanelContract $panel = null) {
        //backtrace(true);
        $panel = PanelService::make()->getRequestPanel();
        if ('' != $request->_act) {
            return $panel->callItemActionWithGate($request->_act);
        }

        return $panel->out();
    }

    /**
     * Undocumented function.
     *
     * @return mixed
     */
    public function showOld(Request $request, ?PanelContract $panel = null) {
        //$request=request();
        $home = null;
        $home = TenantService::model('home');
        $mod_name = PanelService::make()->get($home)->getModuleName();

        $home_controller = '\Modules\\'.$mod_name.'\Http\Controllers\HomeController';

        //dddx($home_controller);

        if ('' != $request->_act) {
            $home = TenantService::model('home');
            $panel = PanelService::make()->get($home);

            return $panel->callItemActionWithGate($request->_act);
        }

        if (class_exists($home_controller) && 'Xot' != $mod_name) {
            return app($home_controller)->show($request);
        }

        try {
            $home = TenantService::modelEager('home');
            $home = $home->firstOrCreate(['id' => 1]);
        } catch (\Exception $e) {
            dddx(['exception' => $e, 'model' => $home]);
        }
        $panel = PanelService::make()->get($home);

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

>>>>>>> 9472ad4 (first)
        return $panel->out();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirect(Request $request) {
<<<<<<< HEAD
        $url = $request->url;
        if (is_string($url)) {
            return redirect($url);
        }

        return redirect('/');
=======
        return redirect($request->url);
>>>>>>> 9472ad4 (first)
    }

    /**
     * Undocumented function.
     *
     * @return mixed
     */
    public function store(Request $request) {
        return $this->index($request);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 9472ad4 (first)
