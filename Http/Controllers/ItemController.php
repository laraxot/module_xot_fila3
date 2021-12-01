<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Modules\Xot\Services\PanelService;

class ItemController extends XotBaseContainerController {
    /*
    public function myRoutes() {
        dddx(getRouteParameters());
    }

    public function index(Request $request) {
        $params = getRouteParameters();
        $panel = PanelService::getByParams($params);

        return $panel->out();
    }
    */
}