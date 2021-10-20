<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Controllers;

use Illuminate\Routing\Controller;

class TestController extends Controller {
    public function myRoutes() {
        dddx(getRouteParameters());
    }
}