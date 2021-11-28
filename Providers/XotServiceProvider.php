<?php

declare(strict_types=1);

namespace Modules\Xot\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Modules\Tenant\Services\TenantService as Tenant;
use Modules\Xot\Http\View\Composers\XotComposer;
use Nwidart\Modules\Facades\Module;

/**
 * Class XotServiceProvider.
 */
class XotServiceProvider extends XotBaseServiceProvider {
    use Traits\TranslatorTrait;
    use Traits\PresenterTrait;
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
        //*
        $this->mergeConfigs();

        if (\Request::has('act') && 'migrate' == \Request::input('act')) {
            DB::purge('mysql'); //Call to a member function prepare() on null
            DB::reconnect('mysql');
        }
        //DB::purge(); //Call to a member function prepare() on null
        // Database connection [mysql] not configured.
        DB::reconnect();
        Schema::defaultStringLength(191);

        $map = config('morph_map');

        Relation::morphMap($map);
        //*/

        Module::enable('Tenant');
        Module::enable('Rating');
        //Module::enable('Tag');

        $this->registerCommands();

        $this->redirectSSL();

        $this->registerTranslator();

        //$this->registerCacheOPCache();
        //$this->registerScout();

        //$this->registerLivewireComponents();
        $this->registerViewComposers();

        //$this->registerPanel();
        //$this->registerDropbox();// PROBLEMA DI COMPOSER
    }

    //end bootCallback

    public function registerCallback(): void {
        $this->loadHelpersFrom(__DIR__.'/../Helpers');
        $loader = AliasLoader::getInstance();
        $loader->alias('Panel', 'Modules\Xot\Services\PanelService');
        $this->registerPresenter();

        //$this->registerPanel();
        //$this->registerBladeDirectives(); //non intercetta
    }

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

    private function registerViewComposers(): void {
        //Factory $view
        //$view->composer('bootstrap-italia::page', BootstrapItaliaComposer::class);
        View::composer('*', XotComposer::class);
        //dddx($res);
    }

    /*
    public function mergeConfigs(): void {
        $configs = ['database', 'filesystems', 'auth', 'metatag', 'services', 'xra', 'social'];
        foreach ($configs as $v) {
            $tmp = Tenant::config($v);
            //dddx($tmp);
        }
        //DB::purge('mysql');//Call to a member function prepare() on null
        //DB::purge('liveuser_general');
        //DB::reconnect();
    }

    //end mergeConfigs
    */
    public function loadHelpersFrom(string $path): void {
        $files = File::files($path);
        foreach ($files as $file) {
            if ('php' == $file->getExtension() && false !== $file->getRealPath()) {
                require_once $file->getRealPath();
            }
        }
    }
} //end class
