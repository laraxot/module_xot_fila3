<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
<<<<<<< HEAD
// use Illuminate\Support\Facades\Response;
// use Illuminate\Support\Str;
use Modules\Xot\Services\PanelService;

// use Illuminate\Http\Response;
=======
//use Illuminate\Support\Facades\Response;
//use Illuminate\Support\Str;
use Modules\Xot\Services\PanelService;

//use Illuminate\Http\Response;
>>>>>>> 9472ad4 (first)

/**
 * Class PanelMiddleware.
 */
<<<<<<< HEAD
class PanelMiddleware {
    /**
     * @return \Illuminate\Http\Response|mixed
     */
    public function handle(Request $request, Closure $next) {
        $route_params = getRouteParameters();
        try {
            $panel = PanelService::make()
                ->getByParams($route_params);
        } catch (\Exception $e) {
            return response()
                ->view('pub_theme::errors.404', ['message' => $e->getMessage(), 'lang' => 'it'], 404);
=======
class PanelMiddleware
{
    /**
     * @return \Illuminate\Http\Response|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $route_params = getRouteParameters();
        try {
            $panel = PanelService::make()->getByParams($route_params);
        } catch (\Exception $e) {
            return response()->view('theme::errors.404', ['message' => $e->getMessage(), 'lang' => 'it'], 404);
>>>>>>> 9472ad4 (first)
        }

        PanelService::make()->setRequestPanel($panel);

        return $next($request);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 9472ad4 (first)
