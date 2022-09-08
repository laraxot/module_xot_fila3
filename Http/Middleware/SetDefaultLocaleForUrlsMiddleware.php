<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Middleware;

/*
 * https://laravel.com/docs/8.x/urls#default-values
 */

use Closure;
use Illuminate\Support\Facades\URL;

/**
 * Class SetDefaultLocaleForUrlsMiddleware.
 */
<<<<<<< HEAD
class SetDefaultLocaleForUrlsMiddleware {
=======
class SetDefaultLocaleForUrlsMiddleware
{
>>>>>>> 9472ad4 (first)
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
<<<<<<< HEAD
    public function handle(\Illuminate\Http\Request $request, Closure $next) {
        URL::defaults(
            [
                'lang' => app()->getLocale(),
                // 'referrer' => url()->previous(),
=======
    public function handle(\Illuminate\Http\Request $request, Closure $next)
    {
        URL::defaults(
            [
                'lang' => app()->getLocale(),
                //'referrer' => url()->previous(),
>>>>>>> 9472ad4 (first)
            ]
        );

        return $next($request);
    }
}
