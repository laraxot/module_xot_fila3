<?php

declare(strict_types=1);

namespace Modules\Xot\Providers;

<<<<<<< HEAD
//use Illuminate\Database\Eloquent\Factory;
=======
>>>>>>> 62ea534012e9d79473f751b4b12ca7271fa0f629
use Exception;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Modules\Xot\Services\LivewireService;
use Nwidart\Modules\Facades\Module;
<<<<<<< HEAD
=======
<<<<<<< HEAD
use TypeError;
=======
>>>>>>> 62ea534012e9d79473f751b4b12ca7271fa0f629
>>>>>>> 5956023 (.)

//use Modules;

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
<<<<<<< HEAD
=======
<<<<<<< HEAD
        //echo '<h3>Time :'.class_basename($this).' '.(microtime(true) - LARAVEL_START).'</h3>';

=======
>>>>>>> 62ea534012e9d79473f751b4b12ca7271fa0f629
>>>>>>> 5956023 (.)
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        //$this->registerFactories();
        $this->loadMigrationsFrom($this->module_dir.'/../Database/Migrations');
        if (method_exists($this, 'bootCallback')) {
            $this->bootCallback();
        }
        //Illuminate\Contracts\Container\BindingResolutionException: Target class [livewire] does not exist.
        $this->registerLivewireComponents();
        //Illuminate\Contracts\Container\BindingResolutionException: Target class [modules] does not exist.
        $this->registerBladeComponents();
<<<<<<< HEAD
=======
<<<<<<< HEAD
        //echo '<h3>Time :'.class_basename($this).' '.(microtime(true) - LARAVEL_START).'</h3>';
=======
>>>>>>> 62ea534012e9d79473f751b4b12ca7271fa0f629
>>>>>>> 5956023 (.)
    }

    /**
     * Register the service provider.
     */
    public function register(): void {
        //dd($this->module_name.' '.RouteServiceProvider::class);
        //dd(dirname(get_class($this))); //Modules\Backend\Providers\BackendServiceProvider
        //dd(__NAMESPACE__);
        //$ns=dirname(get_class($this));
        //dd(get_class($this).' '.$this->module_ns);
        //echo '<h3>Time :'.class_basename($this).' '.(microtime(true) - LARAVEL_START).'</h3>';

        $this->app->register(''.$this->module_ns.'\RouteServiceProvider');
        //get_called_class
        //dd(get_class($this));
        if (method_exists($this, 'registerCallback')) {
            $this->registerCallback();
        }
        //echo '<h3>Time :'.class_basename($this).' '.(microtime(true) - LARAVEL_START).'</h3>';
    }

    /**
     * Register config.
     */
    protected function registerConfig(): void {
        $this->publishes([
            $this->module_dir.'/../Config/config.php' => config_path($this->module_name.'.php'),
        ], 'config');
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
        /*
        $langPath = resource_path('lang/modules/'.$this->module_name);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->module_name);
        } else {
            $this->loadTranslationsFrom($this->module_dir.'/../Resources/lang', $this->module_name);
        }
        */
        $langPath = realpath($this->module_dir.'/../Resources/lang');
        //echo '<hr>'.$langPath.'  :  '.$this->module_name.' <hr/>';
        $this->loadTranslationsFrom($langPath, $this->module_name);
    }

    /**
     * Register an additional directory of factories.
     */
    public function registerFactories(): void {
        if (! app()->environment('production')) {
            //app(Factory::class)->load($this->module_dir.'/../Database/factories');
        }
    }

    public function registerBladeComponents(): void {
        $module = Module::find($this->module_name);
        if (null == $module) {
            throw new \Exception('['.$this->module_name.'] is not found');
        }
<<<<<<< HEAD

=======
<<<<<<< HEAD
        /*
        $methods = get_class_methods($module);
        echo '<table border="1">';
        foreach ($methods as $method) {
            if (Str::startsWith($method, 'get')) {
                try {
                    echo '<tr><td>'.$method.'</td><td>'.print_r($module->{$method}(), true).'</td></tr>';
                } catch (\Exception $e) {
                    echo '<tr><td>'.$method.'</td><td>'.$e->getMessage().'</td></tr>';
                } catch (TypeError $e) {
                    echo '<tr><td>'.$method.'</td><td>'.$e->getMessage().'</td></tr>';
                }
            }
        }
        echo '</table>';
        dddx('a');

        Blade::componentNamespace('Modules\FormX\View\Components', $this->module_name);
        */
=======

>>>>>>> 62ea534012e9d79473f751b4b12ca7271fa0f629
>>>>>>> 5956023 (.)
        $namespace = 'Modules\\'.$module->getName().'\View\Components';

        Blade::componentNamespace($namespace, $module->getLowerName());
    }

    public function registerLivewireComponents(): void {
        LivewireService::registerComponents(
            $this->module_dir.'/../Http/Livewire',
            Str::before($this->module_ns, '\Providers'),
            $this->module_name.'::'
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

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function loadEventsFrom(string $path): void {
        $events = [];
        if (! File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
        $events_file = $path.'/_events.json';
        $force_recreate = request()->input('force_recreate', true);
        if (! File::exists($events_file) || $force_recreate) {
            $filenames = \glob($path.'/*.php');
            if (null == $filenames) {
                $filenames = [];
            }
            foreach ($filenames as $filename) {
                $info = pathinfo($filename);

                //$tmp->namespace='\\'.$vendor.'\\'.$pack.'\\Events\\'.$info['filename'];
                $event_name = $info['filename'];
                $str = 'Event';
                if (Str::endsWith($event_name, $str)) {
                    $listener_name = substr($event_name, 0, -strlen($str)).'Listener';

                    $event = $this->module_base_ns.'\\Events\\'.$event_name;
                    $listener = $this->module_base_ns.'\\Listeners\\'.$listener_name;
                    $msg = [
                        'event' => $event,
                        'event_exists' => class_exists($event),
                        'listener' => $listener,
                        'listener_exists' => class_exists($listener),
                    ];
                    if (class_exists($event) && class_exists($listener)) {
                        //\Event::listen($event, $listener);
                        $tmp = new \StdClass();
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
            $events = json_decode($events);
        }
        foreach ($events as $v) {
            Event::listen($v->event, $v->listener);
        }
    }

    //end function
}