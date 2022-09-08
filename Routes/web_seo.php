<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

$namespace = '\Modules\Xot\Http\Controllers';
$middleware = [
    'web',
<<<<<<< HEAD
    // \Modules\Xot\Http\Middleware\PanelMiddleware::class,
=======
    //\Modules\Xot\Http\Middleware\PanelMiddleware::class,
>>>>>>> 9472ad4 (first)
];

Route::middleware($middleware)
    ->namespace($namespace)
    ->group(
        function () {
            Route::get('/sitemap.xml', 'SitemapXmlController')->name('sitemap_xml');
        }
    );
