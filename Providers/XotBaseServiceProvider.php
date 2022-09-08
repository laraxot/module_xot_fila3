<?php

declare(strict_types=1);

namespace Modules\Xot\Providers;

use Exception;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Modules\Xot\Services\LivewireService;
use Nwidart\Modules\Facades\Module;

<<<<<<< HEAD
// use Modules;
=======
//use Modules;
>>>>>>> 9472ad4 (first)

/**
 * Class XotBaseServiceProvider.
 */
abstract class XotBaseServiceProvider extends ServiceProvider {
    protected string $module_dir = __DIR__;

    protected string $module_ns = __NAMESPACE__;

    public string $module_name = 'formx';

    protected string $module_base_ns;

    /**
     * Boot the application events.
     */
    public function boot(): void {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
<<<<<<< HEAD
        // $this->registerFactories();
=======
        //$this->registerFactories();
>>>>>>> 9472ad4 (first)
        $this->loadMigrationsFrom($this->module_dir.'/../Database/Migrations');
        if (method_exists($this, 'bootCallback')) {
            $this->bootCallback();
        }
<<<<<<< HEAD
        // Illuminate\Contracts\Container\BindingResolutionException: Target class [livewire] does not exist.
        $this->registerLivewireComponents();
        // Illuminate\Contracts\Container\BindingResolutionException: Target class [modules] does not exist.
=======
        //Illuminate\Contracts\Container\BindingResolutionException: Target class [livewire] does not exist.
        $this->registerLivewireComponents();
        //Illuminate\Contracts\Container\BindingResolutionException: Target class [modules] does not exist.
>>>>>>> 9472ad4 (first)
        $this->registerBladeComponents();
    }

    /**
     * Register the service provider.
     */
    public function register(): void {
        $this->module_ns = collect(explode('\\', $this->module_ns))->slice(0, -1)->implode('\\');
        $this->app->register(''.$this->module_ns.'\Providers\RouteServiceProvider');
        if (method_exists($this, 'registerCallback')) {
            $this->registerCallback();
        }
<<<<<<< HEAD
        // echo '<h3>Time :'.class_basename($this).' '.(microtime(true) - LARAVEL_START).'</h3>';
=======
        //echo '<h3>Time :'.class_basename($this).' '.(microtime(true) - LARAVEL_START).'</h3>';
>>>>>>> 9472ad4 (first)
    }

    /**
     * Register config.
     */
    protected function registerConfig(): void {
        $this->publishes(
            [
                $this->module_dir.'/../Config/config.php' => config_path($this->module_name.'.php'),
            ], 'config'
        );
        $this->mergeConfigFrom(
            $this->module_dir.'/../Config/config.php',
            $this->module_name
        );
    }

    /**
     * Register views.
     */
    public function registerViews(): void {
        $sourcePath = realpath($this->module_dir.'/../Resources/views');
        if (false === $sourcePath) {
            throw new Exception('realpath not find dir');
        }
        /*
        $viewPath = resource_path('views/modules/'.$this->module_name);


        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/'.$this->module_name;
        }, \Config::get('view.paths')), [$sourcePath]), $this->module_name);
        */
        $this->loadViewsFrom($sourcePath, $this->module_name);
    }

    /**
     * Register translations.
     */
    public function registerTranslations(): void {
        $langPath = realpath($this->module_dir.'/../Resources/lang');
<<<<<<< HEAD
        if (false == $langPath) {
            throw new Exception('['.__LINE__.']['.__FILE__.']');
        }
        // echo '<hr>'.$langPath.'  :  '.$this->module_name.' <hr/>';
        $this->loadTranslationsFrom($langPath, $this->module_name);
=======
        //echo '<hr>'.$langPath.'  :  '.$this->module_name.' <hr/>';
        $this->loadTranslationsFrom($langPath, $this->module_name);
        
>>>>>>> 9472ad4 (first)
    }

    /**
     * Register an additional directory of factories.
     */
    public function registerFactories(): void {
        if (! app()->environment('production')) {
<<<<<<< HEAD
            // app(Factory::class)->load($this->module_dir.'/../Database/factories');
=======
            //app(Factory::class)->load($this->module_dir.'/../Database/factories');
>>>>>>> 9472ad4 (first)
        }
    }

    public function registerBladeComponents(): void {
        /*
        $module = Module::find($this->module_name);
        if (null == $module) {
            throw new \Exception('['.$this->module_name.'] is not found');
        }

        $namespace = 'Modules\\'.$module->getName().'\View\Components';

        Blade::componentNamespace($namespace, $module->getLowerName());
        */
        $namespace = $this->module_ns.'\View\Components';
        Blade::componentNamespace($namespace, $this->module_name);
    }

<<<<<<< HEAD
    /**
     * Undocumented function.
     */
    public function registerLivewireComponents(): void {
        // $prefix=$this->module_name.'::';
        $prefix = '';
        LivewireService::registerComponents(
            $this->module_dir.'/../Http/Livewire',
            Str::before($this->module_ns, '\Providers'),
            $prefix,
=======
    public function registerLivewireComponents(): void {
        LivewireService::registerComponents(
            $this->module_dir.'/../Http/Livewire',
            Str::before($this->module_ns, '\Providers'),
            $this->module_name.'::'
>>>>>>> 9472ad4 (first)
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return [];
    }

<<<<<<< HEAD

    /**
     * Undocumented function
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @param string $path
     * @return array
     */
    public function getEventsFrom(string $path): array {
=======
    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function loadEventsFrom(string $path): void {
>>>>>>> 9472ad4 (first)
        $events = [];
        if (! File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
        $events_file = $path.'/_events.json';
        $force_recreate = request()->input('force_recreate', true);
        if (! File::exists($events_file) || $force_recreate) {
<<<<<<< HEAD
            $filenames = glob($path.'/*.php');
            if (false == $filenames) {
=======
            $filenames = \glob($path.'/*.php');
            if (null == $filenames) {
>>>>>>> 9472ad4 (first)
                $filenames = [];
            }
            foreach ($filenames as $filename) {
                $info = pathinfo($filename);

<<<<<<< HEAD
                // $tmp->namespace='\\'.$vendor.'\\'.$pack.'\\Events\\'.$info['filename'];
                $event_name = $info['filename'];
                $str = 'Event';
                if (Str::endsWith($event_name, $str)) {
                    $listener_name = substr($event_name, 0, -\strlen($str)).'Listener';
=======
                //$tmp->namespace='\\'.$vendor.'\\'.$pack.'\\Events\\'.$info['filename'];
                $event_name = $info['filename'];
                $str = 'Event';
                if (Str::endsWith($event_name, $str)) {
                    $listener_name = substr($event_name, 0, -strlen($str)).'Listener';
>>>>>>> 9472ad4 (first)

                    $event = $this->module_base_ns.'\\Events\\'.$event_name;
                    $listener = $this->module_base_ns.'\\Listeners\\'.$listener_name;
                    $msg = [
                        'event' => $event,
                        'event_exists' => class_exists($event),
                        'listener' => $listener,
                        'listener_exists' => class_exists($listener),
                    ];
                    if (class_exists($event) && class_exists($listener)) {
<<<<<<< HEAD
                        // \Event::listen($event, $listener);
=======
                        //\Event::listen($event, $listener);
>>>>>>> 9472ad4 (first)
                        $tmp = new \stdClass();
                        $tmp->event = $event;
                        $tmp->listener = $listener;
                        $events[] = $tmp;
                    }
                }
            }
            try {
                $events_content = json_encode($events);
                if (false === $events_content) {
                    throw new Exception('can not encode json');
                }
                File::put($events_file, $events_content);
            } catch (\Exception $e) {
                dd($e);
            }
        } else {
            $events = File::get($events_file);
            $events = (array) json_decode($events);
        }
<<<<<<< HEAD

        return $events;
    }

    /** 
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function loadEventsFrom(string $path): void {
        $events=$this->getEventsFrom($path);
=======
>>>>>>> 9472ad4 (first)
        foreach ($events as $v) {
            Event::listen($v->event, $v->listener);
        }
    }

<<<<<<< HEAD
    // end function
    
}
=======
    //end function
}
>>>>>>> 9472ad4 (first)
