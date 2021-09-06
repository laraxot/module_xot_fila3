<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Theme\Services\ThemeService;

/*
* gestisce i module
*/

///*

/**
 * Class ModuleController.
 */
class ModuleController extends XotBaseContainerController {
}
//*/
/*
class ModuleController extends Controller {
    public function index(Request $request) {
        $params = optional(\Route::current())->parameters();
        $home_view = $params['module'].'::admin.index';

        if (\View::exists($home_view)) {
            return view($home_view);
        }

        return ThemeService::view('xot::admin.home');
    }
}
*/
