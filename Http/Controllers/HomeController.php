<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Controllers;

use Exception;
use Illuminate\Database\Schema\Blueprint;
// ---- services ---

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Schema;
use Modules\Tenant\Services\TenantService;
use Modules\Xot\Contracts\PanelContract;
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
            // $model = TenantService::modelEager('home');
            $model = getModelByName('home');
            $home = $model->firstOrCreate(['id' => 1]);
        } catch (\Exception $e) {
            dddx('run migrations');
        }
        if (null === $home) {
            throw new \Exception('home is null');
        }

        $home_panel = PanelService::make()->get($home);
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

        return $panel->out();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirect(Request $request) {
        $url = $request->url;
        if (is_string($url)) {
            return redirect($url);
        }

        return redirect('/');
    }

    /**
     * Undocumented function.
     *
     * @return mixed
     */
    public function store(Request $request) {
        return $this->index($request);
    }
}