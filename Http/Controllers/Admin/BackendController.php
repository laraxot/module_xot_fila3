<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
//--- services
//use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
//--- traits
use Modules\Theme\Services\ThemeService;
use Modules\Xot\Services\ArtisanService;

/**
 * Class BackendController.
 */
class BackendController extends Controller
{
    /**
     * @return mixed|string
     */
    public function index(Request $request)
    {
        if ('routelist' == $request->act) {
            return ArtisanService::exe('route:list');
        }

        return ThemeService::view();
    }

    public function dashboard(Request $request): View
    {
        /*
        $out = ArtisanService::act($request->act);
        if ('' != $out) {
            return $out;
        }
        */
        //return view('adm_theme::admin.dashboard');
        //return ThemeService::view('adm_theme::admin.dashboard');
        $view = 'adm_theme::admin.dashboard';
        if (! view()->exists($view)) {
            /*
            dddx([
                'err' => 'view not exists',
                'view' => $view,
                'adm_theme' => config('xra.adm_theme'),
            ]);
            */
            throw new \Exception('view['.$view.'] not exists adm_theme['.config('xra.adm_theme').']');
        }

        return view()->make($view);
    }
}
