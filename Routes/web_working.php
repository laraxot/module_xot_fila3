<?php

declare(strict_types=1);

use Modules\Xot\Services\RouteDynService;

$namespace = '\Modules\Xot';
$pack = class_basename($namespace);

$namespace .= '\Http\Controllers';
<<<<<<< HEAD
// $middleware = ['web', 'guest']; //guest ti riindirizza se non sei loggato
=======
//$middleware = ['web', 'guest']; //guest ti riindirizza se non sei loggato
>>>>>>> 9472ad4 (first)
$middleware = ['web', \Modules\Xot\Http\Middleware\PanelMiddleware::class];

$areas_prgs = RouteDynService::generate();
if (! config('xra.disable_frontend_dynamic_route')) {
    $prefix = '{lang}';
    Route::group(
        [
            'prefix' => $prefix,
            'middleware' => $middleware,
            'namespace' => $namespace,
            'where' => [
<<<<<<< HEAD
                // 'container0' => '!password',
                // 'container0' => '^(?!admin$).*$',
                // 'lang' => 'it|en',
=======
                //'container0' => '!password',
                //'container0' => '^(?!admin$).*$',
                //'lang' => 'it|en',
>>>>>>> 9472ad4 (first)
            ],
        ],
        function () use ($areas_prgs, $namespace): void {
            RouteDynService::dynamic_route($areas_prgs, null, $namespace);
            Route::get('/', 'HomeController@show')->name('lang');
            Route::get('/home', 'HomeController@show')->name('lang.home');
        }
    );

    Route::group(
        [
            'prefix' => null,
            'middleware' => $middleware,
            'namespace' => $namespace,
        ],
        function (): void {
<<<<<<< HEAD
            // Route::get('/', 'HomeController@show')->name('home'); //show o index ? homecontrller@show o pagecontroller@home ?
            // Route::post('/', 'HomeController@show')->name('home'); //togliere o tenere ?
            Route::match(['get', 'post'], '/', 'HomeController@show')->name('home'); // togliere o tenere ?
            Route::redirect('/home', '/'); // togliere o tenere ?
=======
            //Route::get('/', 'HomeController@show')->name('home'); //show o index ? homecontrller@show o pagecontroller@home ?
            //Route::post('/', 'HomeController@show')->name('home'); //togliere o tenere ?
            Route::match(['get', 'post'], '/', 'HomeController@show')->name('home'); //togliere o tenere ?
            Route::redirect('/home', '/'); //togliere o tenere ?
>>>>>>> 9472ad4 (first)

            Route::get('/redirect', 'HomeController@redirect')->name('redirect');
        }
    );
}

<<<<<<< HEAD
$middleware = ['web', 'auth'/* ,'verified' */];
=======
$middleware = ['web', 'auth'/*,'verified'*/];
>>>>>>> 9472ad4 (first)
$prefix = 'admin';

Route::group(
    [
        'prefix' => $prefix,
        'middleware' => $middleware,
        'namespace' => $namespace.'\Admin',
    ],
    function (): void {
        Route::get('/', 'BackendController@dashboard')->name('admin');
    }
);

$areas_adm = [
    [
        'name' => '{module}',
        'as' => 'admin.',
<<<<<<< HEAD
        'param_name' => 'lang',  // ero titubante su questo
        // 'only' => ['index', 'store'],
        'only' => [],
        'subs' => $areas_prgs,
    ],
    // $item0,
=======
        'param_name' => 'lang',  //ero titubante su questo
        //'only' => ['index', 'store'],
        'only' => [],
        'subs' => $areas_prgs,
    ],
    //$item0,
>>>>>>> 9472ad4 (first)
];
$prefix = 'admin';
$middleware = [
    'web',
    'auth',
    \Modules\Xot\Http\Middleware\PanelMiddleware::class,
];
$namespace .= '\Admin';
Route::group(
    [
        'prefix' => $prefix,
        'middleware' => $middleware,
        'namespace' => $namespace,
    ],
    function () use ($areas_adm, $namespace): void {
        RouteDynService::dynamic_route($areas_adm, null, $namespace);
    }
);

Route::group(
    [
        'prefix' => 'admin',
        'middleware' => $middleware,
        'namespace' => $namespace,
    ],
    function (): void {
<<<<<<< HEAD
        // Route::get('{module}', 'ModuleController@home')->name('admin.show');
        // Route::put('{module}', 'ModuleController@home')->name('admin.show');
=======
        //Route::get('{module}', 'ModuleController@home')->name('admin.show');
        //Route::put('{module}', 'ModuleController@home')->name('admin.show');
>>>>>>> 9472ad4 (first)
        Route::match(['get', 'put'], '{module}', 'ModuleController@home')->name('admin.show');
    }
);

require_once 'seo.php';
require_once 'gdpr.php';
