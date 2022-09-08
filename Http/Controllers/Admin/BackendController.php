<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Controllers\Admin;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
// --- services
// use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
// --- traits
//use Modules\Theme\Services\ThemeService;
//use Modules\Xot\Services\ArtisanService;

/**
 * Class BackendController.
 */
class BackendController extends Controller {
    /**
     * @return mixed|string
     */
    public function index(Request $request) {

        //return ThemeService::view();
        /**
        * @phpstan-var view-string
        */
        $view = 'adm_theme::admin.index';
        return view()->make($view);
    }

    public function dashboard(Request $request): View {
        /**
        * @phpstan-var view-string
        */
        $view = 'adm_theme::admin.dashboard';
        if (! view()->exists($view)) {
            throw new Exception('view['.$view.'] not exists adm_theme['.config('xra.adm_theme').']');
        }

        return view()->make($view);
    }
}
