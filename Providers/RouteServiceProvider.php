<?php

declare(strict_types=1);

namespace Modules\Xot\Providers;

use Exception;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Modules\Tenant\Services\TenantService;
use Modules\Xot\Http\Middleware\SetDefaultLocaleForUrlsMiddleware;

// public function boot(\Illuminate\Routing\Router $router)

<<<<<<< HEAD
// --- bases -----
=======
//--- bases -----
>>>>>>> 9472ad4 (first)

class RouteServiceProvider extends XotBaseRouteServiceProvider {
    /**
     * The module namespace to assume when generating URLs to actions.
     */
    protected string $moduleNamespace = 'Modules\Xot\Http\Controllers';

    /**
     * The module directory.
     */
    protected string $module_dir = __DIR__;

    /**
     * The module namespace.
     */
    protected string $module_ns = __NAMESPACE__;

    public function bootCallback(): void {
<<<<<<< HEAD
        // 36     Cannot access offset 'router' on Illuminate\Contracts\Foundation\Application
        // $router = $this->app['router'];
        $router = app('router');
        // dddx([$router, $router1]);
=======
        //36     Cannot access offset 'router' on Illuminate\Contracts\Foundation\Application
        //$router = $this->app['router'];
        $router = app('router');
        //dddx([$router, $router1]);
>>>>>>> 9472ad4 (first)

        $this->registerLang();
        $this->registerRoutePattern($router);
        $this->registerMyMiddleware($router);
    }

    public function registerMyMiddleware(Router $router): void {
<<<<<<< HEAD
        // $router->pushMiddlewareToGroup('web', SetDefaultLocaleForUrlsMiddleware::class);
=======
        //$router->pushMiddlewareToGroup('web', SetDefaultLocaleForUrlsMiddleware::class);
>>>>>>> 9472ad4 (first)
        $router->prependMiddlewareToGroup('web', SetDefaultLocaleForUrlsMiddleware::class);
        $router->prependMiddlewareToGroup('api', SetDefaultLocaleForUrlsMiddleware::class);
    }

    /**
     * Undocumented function.
     */
    public function registerLang(): void {
<<<<<<< HEAD
        /**
         * @var array
         */
        $locales=config('laravellocalization.supportedLocales');
        $langs = array_keys($locales);

        if (! \is_array($langs)) {
            throw new Exception('[.__LINE__.]['.class_basename(__CLASS__).']');
        }
        if (\in_array(\Request::segment(1), $langs, true)) {
=======
        $langs = array_keys(config('laravellocalization.supportedLocales'));
        if (! is_array($langs)) {
            throw new Exception('[.__LINE__.]['.class_basename(__CLASS__).']');
        }
        if (in_array(\Request::segment(1), $langs)) {
>>>>>>> 9472ad4 (first)
            $lang = \Request::segment(1);
            if (null !== $lang) {
                App::setLocale($lang);
            }
        }
    }

    public function registerRoutePattern(Router $router): void {
<<<<<<< HEAD
        // ---------- Lang Route Pattern
        $langs = config('laravellocalization.supportedLocales');
        if (! \is_array($langs)) {
            throw new Exception('[.__LINE__.]['.class_basename(__CLASS__).']');
        }
        $lang_pattern = collect(array_keys($langs))->implode('|');
        $lang_pattern = '/|'.$lang_pattern.'|/i';
        $router->pattern('lang', $lang_pattern);
        // -------------------------------------------------------------
        // $models = TenantService::config('morph_map');
        $models = config('morph_map');
        if (! \is_array($models)) {
            // throw new Exception('[' . print_r($models, true) . '][' . __LINE__ . '][' . class_basename(__CLASS__) . ']');
            $models = [];
        }
        $models_collect = collect(array_keys($models));
=======
        //---------- Lang Route Pattern
        $langs = config('laravellocalization.supportedLocales');
        if (! is_array($langs)) {
            throw new Exception('[.__LINE__.]['.class_basename(__CLASS__).']');
        }
        $lang_pattern = collect(\array_keys($langs))->implode('|');
        $lang_pattern = '/|'.$lang_pattern.'|/i';
        $router->pattern('lang', $lang_pattern);
        //-------------------------------------------------------------
        //$models = TenantService::config('morph_map');
        $models = config('morph_map');
        if (! is_array($models)) {
            throw new Exception('['.__LINE__.']['.class_basename(__CLASS__).']');
        }
        $models_collect = collect(\array_keys($models));
>>>>>>> 9472ad4 (first)
        $pattern = $models_collect->implode('|');
        $pattern_plural = $models_collect->map(
            function ($item) {
                return Str::plural((string) $item);
            }
        )->implode('|');

<<<<<<< HEAD
        // $pattern = '/|'.$pattern.'|/i';
=======
        //$pattern = '/|'.$pattern.'|/i';
>>>>>>> 9472ad4 (first)
        $container0_pattern = '/|'.$pattern.'|'.$pattern_plural.'|/i';
        /*--pattern vuoto
        dddx([
            'lang_pattern' => $lang_pattern,
            'container0_pattern' => $container0_pattern,
            'config_path' => TenantService::getConfigPath('morph_map'),
        ]);
        */
<<<<<<< HEAD
        // $router->pattern('container0', $container0_pattern);
    }

    // end registerRoutePattern
}
=======
        //$router->pattern('container0', $container0_pattern);
    }

    //end registerRoutePattern
}
>>>>>>> 9472ad4 (first)
