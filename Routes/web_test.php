<?php

declare(strict_types=1);

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
        //corretto che sia diverso da name,
        'uri_full' => '/{container0?}/{item0?}/{container1?}/{item1?}/{container2?}/{item2?}/{container3?}/{item3?}/{container4?}',
    ],
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
//$controller = 'ItemController';
$controller = 'ContainersController';

$front_acts = collect($acts)->filter(
    function ($item) {
        return in_array($item->name, ['index', 'show']);
    }
)->all();

$middleware = [
    'web',
    \Modules\Xot\Http\Middleware\PanelMiddleware::class,
];
$namespace = '\Modules\Xot\Http\Controllers';
$prefix = '/{lang?}';
$as = null;

myRoutes($name, $middleware, $namespace, $prefix, $as, $controller, $front_acts);

$middleware = [
    'web',
    'auth',
    \Modules\Xot\Http\Middleware\PanelMiddleware::class,
];
$namespace = '\Modules\Xot\Http\Controllers\Admin';

$prefix = '/admin/{module?}/{lang?}';
$as = 'admin.';

myRoutes($name, $middleware, $namespace, $prefix, $as, $controller, $acts);

function myRoutes($name, $middleware, $namespace, $prefix, $as, $controller, $acts) {
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
                ->name('item.'.$act->name)
                //->where(['container1' => '[0-9]+']) //errato solo per test
                ;
            }
        }
    );
}
