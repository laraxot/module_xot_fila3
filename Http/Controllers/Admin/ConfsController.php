<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Tenant\Services\TenantService;
use Modules\Xot\Services\PanelService;

/**
 * Class ConfController.
 */
class ConfsController extends Controller
{
    /**
     * Undocumented function.
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        //$rows = TenantService::getConfigNames();
        $panel = PanelService::getRequestPanel();

        return $panel->out();
    }

    /**
     * Undocumented function.
     *
     * @return Renderable|string
     */
    public function edit(Request $request)
    {
        $data = $request->all();
        $route_params = getRouteParameters();
        [$containers,$items] = params2ContainerItem($route_params);
        $config_name = last($items); //google
        $name = TenantService::getName();
        $config_key = Str::replace('/', '.', $name.'/'.$config_name);
        $filename = TenantService::filePath($config_name.'.php');
        /*
        dddx([
            'config_name' => $config_name,
            'name' => $name,
            'config_key' => $config_key,
            'test1' => config($config_key),
            'filename' => $filename,
        ]);

        return 'preso';
        */
        $view = 'theme::admin.standalone.manage.php-array';
        $view_params = [
            'view' => $view,
            'filename' => $filename,
        ];

        return view()->make($view, $view_params);
    }
}
