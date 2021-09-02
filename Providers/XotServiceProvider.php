<?php

declare(strict_types=1);

namespace Modules\Xot\Providers;

use Illuminate\Cache\TagSet;
use Illuminate\Contracts\Container\Container;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
//use Modules\Xot\Engines\Opcache;
//--- services ---
use Illuminate\Support\Facades\URL;
//use Laravel\Scout\EngineManager;
use Illuminate\Support\Facades\View;
use Illuminate\Translation\Translator;
use League\Flysystem\Filesystem;
use Modules\Xot\Contracts\PanelPresenterContract;
//use Modules\Xot\Engines\FullTextSearchEngine;
use Modules\Xot\Http\View\Composers\XotComposer;
use Modules\Xot\Presenters\GeoJsonPanelPresenter;
use Modules\Xot\Presenters\HtmlPanelPresenter;
use Modules\Xot\Presenters\JsonPanelPresenter;
use Modules\Xot\Services\TenantService as Tenant;
use Modules\Xot\Services\TranslatorService;
use Spatie\Dropbox\Client as DropboxClient; // per dizionario morph
use Spatie\FlysystemDropbox\DropboxAdapter; // per slegarmi da tntsearch

/**
 * Class XotServiceProvider.
 */
class XotServiceProvider extends XotBaseServiceProvider {
    /**
     * The module directory.
     */
    protected string $module_dir = __DIR__;

    /**
     * The module namespace.
     */
    protected string $module_ns = __NAMESPACE__;

    public string $module_name = 'xot';

    public function bootCallback(): void {
        $this->mergeConfigs();

        if (\Request::has('act') && 'migrate' == \Request::input('act')) {
            DB::purge('mysql'); //Call to a member function prepare() on null
            DB::reconnect('mysql');
        }
        //DB::purge(); //Call to a member function prepare() on null
        //* //Database connection [mysql] not configured.
        DB::reconnect();
        Schema::defaultStringLength(191);
        //*/
        $map = config('xra.model');

        Relation::morphMap($map);

        $this->registerCommands();

        $this->redirectSSL();

        $this->registerTranslator();

        $this->registerCacheOPCache();

        $this->registerScout();

        //$this->registerLivewireComponents();
        $this->registerViewComposers();

        //$this->registerPanel();
        //$this->registerDropbox();// PROBLEMA DI COMPOSER
    }

    //end bootCallback

    private function redirectSSL(): void {
        if (config('xra.forcessl')) {
            // --- meglio ficcare un controllo anche sull'env
            if (isset($_SERVER['SERVER_NAME']) && 'localhost' != $_SERVER['SERVER_NAME']
                && isset($_SERVER['REQUEST_SCHEME']) && 'http' == $_SERVER['REQUEST_SCHEME']
            ) {
                URL::forceScheme('https');
                /*
                 * da fare in htaccess
                 **/
                if (! request()->secure() /* && in_array(env('APP_ENV'), ['stage', 'production']) */) {
                    exit(redirect()->secure(request()->getRequestUri()));
                }
            }
        }
    }

    private function registerCommands(): void {
        $this->commands([
            \Modules\Xot\Console\CreateAllRepositoriesCommand::class,
            \Modules\Xot\Console\PanelMakeCommand::class,
            \Modules\Xot\Console\FixProvidersCommand::class,
        ]);
    }

    private function registerScout(): void {
        /* --- Scout lo ho tolto per ora
        resolve(\Laravel\Scout\EngineManager::class)->extend('fulltext', function () {
            return new FullTextSearchEngine();
        });
        */
    }

    /*
    // lo riabilitiamo in futuro
    private function registerDropbox(): void {
        Storage::extend('dropbox', function ($app, $config) {
            //dddx($config);

            $client = new DropboxClient($config['authorizationToken']);
            $adapter = new DropboxAdapter($client);
            $filesystem = new Filesystem($adapter, ['case_sensitive' => false]);

            return $filesystem;
        });
    }
    */

    private function registerPanel(): void {
        //dddx(get_class_methods($this->app['request']));
        //dddx(get_class_methods($this->app['route']));
        //dddx(request()->route()->paremeters());
        //$request->route()->parameters()
        //{{ URL::toCurrentRouteWithParameters(['language' => 'az']) }}
        //dddx(optional(\Route::current())->parameters());
        //dddx(request()->route()->parameters());
        /*
        $this->app->singleton(
            Panel::class,
            function (Container $app) {
                return new Panel(
                    $app['events'],
                    $app['route'],
                    $app
                );
            }
        );
        */
    }

    private function registerViewComposers(): void {
        //Factory $view
        //$view->composer('bootstrap-italia::page', BootstrapItaliaComposer::class);
        View::composer('*', XotComposer::class);
        //dddx($res);
    }

    public function mergeConfigs(): void {
        $configs = ['database', 'filesystems', 'auth', 'metatag', 'services', 'xra', 'social'];
        foreach ($configs as $v) {
            $tmp = Tenant::config($v);
            //ddd($tmp);
        }
        //DB::purge('mysql');//Call to a member function prepare() on null
        //DB::purge('liveuser_general');
        //DB::reconnect();
    }

    //end mergeConfigs

    public function registerCallback(): void {
        $this->loadHelpersFrom(__DIR__.'/../Helpers');
        $loader = AliasLoader::getInstance();
        $loader->alias('Panel', 'Modules\Xot\Services\PanelService');

        $responseType = request()->input('responseType');
        $responses = [
            //'html'=> HtmlPanelPresenter::class,//default
            'json' => JsonPanelPresenter::class,
            'geoJson' => GeoJsonPanelPresenter::class,
            //'pdf'=>PdfPanelPresenter::class,
            //'xls'=>XlsPanelPresenter::class,
        ];
        $response = HtmlPanelPresenter::class;
        if (isset($responses[$responseType])) {
            $response = $responses[$responseType];
        }

        $this->app->bind(
            PanelPresenterContract::class,
            //HtmlPanelPresenter::class,
            $response,
        );

        //$this->registerPanel();
    }

    public function loadHelpersFrom(string $path): void {
        //Argument of an invalid type array<int, string>|false supplied for foreach, only iterables are supported.
        $files = File::files($path);
        foreach ($files as $file) {
            if ('php' == $file->getExtension() && false !== $file->getRealPath()) {
                require_once $file->getRealPath();
            }
        }
        /*
        foreach (\glob($path.'/*.php') as $filename) {
            $filename = \str_replace('/', \DIRECTORY_SEPARATOR, $filename);
            require_once $filename;
        }
        */
    }

    /*

    function is_iterable($var)
{
    return $var !== null
        && (is_array($var)
            || $var instanceof Traversable
            || $var instanceof Iterator
            || $var instanceof IteratorAggregate
            );
}
*/

    public function registerTranslator(): void {
        // Override the JSON Translator
        $this->app->extend('translator', function (Translator $translator) {
            $trans = new TranslatorService($translator->getLoader(), $translator->getLocale());
            $trans->setFallback($translator->getFallback());

            return $trans;
        });
    }

    public function registerCacheOPCache(): void {
        /*
        Cache::extend('opcache', function () {
            $store = new \Modules\Xot\Engines\Opcache\Store();

            return new \Modules\Xot\Engines\Opcache\Repository($store, new TagSet($store));
        });
        //
        //Session::extend('opcache', function () {
        //    $store = new \Modules\Xot\Engines\Opcache\Store();

        //    return new \Modules\Xot\Engines\Opcache\Repository($store, new TagSet($store));
        //});

        // Extend Collection to implement __set_state magic method
        if (! Collection::hasMacro('__set_state')) {
            Collection::macro('__set_state', function (array $array) {
                return new Collection($array['items']);
            });
        }
        */
    }
} //end class
