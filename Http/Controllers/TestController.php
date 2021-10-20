<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Request;
use Modules\Xot\Services\PanelService;

class TestController extends Controller {
    public function myRoutes() {
        dddx(getRouteParameters());
    }

    public function index(Request $request) {
        $params = getRouteParameters();
        $panel = PanelService::getByParams($params);

        return $panel->out();
    }
}