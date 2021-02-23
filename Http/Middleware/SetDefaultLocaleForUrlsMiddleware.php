<<<<<<< HEAD
<?php

namespace Modules\Xot\Http\Middleware;

/*
 * https://laravel.com/docs/8.x/urls#default-values
 */

use Closure;
use Illuminate\Support\Facades\URL;

/**
 * Class SetDefaultLocaleForUrlsMiddleware
 * @package Modules\Xot\Http\Middleware
 */
class SetDefaultLocaleForUrlsMiddleware {
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return \Illuminate\Http\Response
     */
    public function handle(\Illuminate\Http\Request $request, Closure $next) {
        URL::defaults(
            [
                'lang' => app()->getLocale(),
                //'referrer' => url()->previous(),
            ]
        );

        return $next($request);
    }
}
=======
<?php

namespace Modules\Xot\Http\Middleware;

/*
 * https://laravel.com/docs/8.x/urls#default-values
 */

use Closure;
use Illuminate\Support\Facades\URL;

/**
 * Class SetDefaultLocaleForUrlsMiddleware
 * @package Modules\Xot\Http\Middleware
 */
class SetDefaultLocaleForUrlsMiddleware {
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return \Illuminate\Http\Response
     */
    public function handle(\Illuminate\Http\Request $request, Closure $next) {
        URL::defaults(
            [
                'lang' => app()->getLocale(),
                //'referrer' => url()->previous(),
            ]
        );

        return $next($request);
    }
}
>>>>>>> 3c97c308c85924a62f31c89c71edfe23450749f0
