<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use Modules\Cms\Services\RouteService;
=======
>>>>>>> 9472ad4 (first)

$acts = [
    (object) [
        'name' => 'create',
        'methods' => ['get', 'head'],
        'uri' => '/create',
    ],
    (object) [
        'name' => 'edit',
        'methods' => ['get', 'head'],
        'uri' => '/edit',
    ],
    (object) [
        'name' => 'index_edit',
        'methods' => ['get', 'head'],
        'uri' => '/index_edit',
    ],
    (object) [
<<<<<<< HEAD
        'name' => 'attach',
        'methods' => ['get', 'head', 'post', 'put'],
        'uri' => '/attach',
    ],
    (object) [
=======
>>>>>>> 9472ad4 (first)
        'name' => 'detach',
        'methods' => ['get', 'head'],
        'uri' => '/detach',
    ],
    (object) [
        'name' => 'store',
        'methods' => ['post'],
        'uri' => '',
    ],
    (object) [
        'name' => 'update',
        'methods' => ['put', 'patch'],
        'uri' => '',
    ],
    (object) [
        'name' => 'index',
        'methods' => ['get', 'head'],
        'uri' => '',
<<<<<<< HEAD
        // corretto che sia diverso da name,
=======
        //corretto che sia diverso da name,
>>>>>>> 9472ad4 (first)
        'uri_full' => '/{container0?}/{item0?}/{container1?}/{item1?}/{container2?}/{item2?}/{container3?}/{item3?}/{container4?}',
    ],
    /*(object) [
        'name' => 'home',
        'methods' => ['get', 'head'],
        'uri' => '',
        //corretto che sia diverso da name,
        'uri_full' => '',
    ],
    */
    (object) [
        'name' => 'show',
        'methods' => ['get', 'head'],
        'uri' => '',
    ],
    (object) [
        'name' => 'destroy',
        'methods' => ['delete'],
        'uri' => '',
    ],
];

$name = '/{container0?}/{item0?}/{container1?}/{item1?}/{container2?}/{item2?}/{container3?}/{item3?}/{container4?}/{item4?}';
<<<<<<< HEAD
// $controller = 'ItemController';
=======
//$controller = 'ItemController';
>>>>>>> 9472ad4 (first)
$controller = 'ContainersController';

$front_acts = collect($acts)->filter(
    function ($item) {
<<<<<<< HEAD
        return in_array($item->name, ['index', 'show'], true);
=======
        return in_array($item->name, ['index', 'show']);
>>>>>>> 9472ad4 (first)
    }
)->all();

$middleware = [
    'web',
    \Modules\Xot\Http\Middleware\PanelMiddleware::class,
];
$namespace = '\Modules\Xot\Http\Controllers';
$prefix = '/{lang?}';
<<<<<<< HEAD
$as = ''; // null
=======
$as = ''; //null
>>>>>>> 9472ad4 (first)
if (! config('xra.disable_frontend_dynamic_route', false)) {
    Route::middleware($middleware)
        ->namespace($namespace)
        ->group(
            function () use ($controller) {
                Route::get('/', $controller.'@home')->name('home');
                Route::get('/home', $controller.'@home')->name('wellcome');
            }
        );

<<<<<<< HEAD
    RouteService::myRoutes($name, $middleware, $namespace, $prefix, $as, $controller, $front_acts);
=======
    myRoutes($name, $middleware, $namespace, $prefix, $as, $controller, $front_acts);
>>>>>>> 9472ad4 (first)
}

$middleware = [
    'web',
    'auth',
    \Modules\Xot\Http\Middleware\PanelMiddleware::class,
];
$namespace = '\Modules\Xot\Http\Controllers\Admin';

$prefix = '/admin/{module?}/{lang?}';
$as = 'admin.';

<<<<<<< HEAD
RouteService::myRoutes($name, $middleware, $namespace, $prefix, $as, $controller, $acts);

/*
=======
myRoutes($name, $middleware, $namespace, $prefix, $as, $controller, $acts);

/**
>>>>>>> 9472ad4 (first)
 * Undocumented function.
 *
 * @return void
 */
<<<<<<< HEAD
=======
function myRoutes(
    string $name,
    array $middleware,
    string $namespace,
    string $prefix,
    string $as,
    string $controller,
    array $acts
) {
    Route::middleware($middleware)
        ->namespace($namespace)
        ->prefix($prefix)
        ->as($as)
        ->group(
            function () use ($name, $controller, $acts) {
                foreach ($acts as $act) {
                    //$uri = ($act->uri_full ?? $name).$act->uri;
                    $uri = $act->uri.($act->uri_full ?? $name);
                    Route::match($act->methods, $uri, $controller.'@'.$act->name)
                    ->name('containers.'.$act->name)
                    //->where(['container1' => '[0-9]+']) //errato solo per test
                    ;
                }
            }
        );
}
>>>>>>> 9472ad4 (first)
