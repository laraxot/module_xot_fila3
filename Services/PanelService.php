<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Modules\Xot\Contracts\ModelContract;
use Modules\Xot\Contracts\PanelContract;
use Modules\Xot\Contracts\UserContract;

/**
 * Class PanelService.
 */
class PanelService {
    private static ?PanelService $_instance = null;

    /**
     * @var Model|ModelContract|UserContract
     */
    private static $model;

    private static ?PanelContract $panel;

    private array $route_params;

    /*
    public function __construct($model){
    $this->model=$model;
    }
     */

    public function __construct(array $route_params) {
        $this->route_params = $route_params;
        //static::$panel = $this->getByRouteParams($route_params);
    }

    public static function getInstance(): self {
        if (null === self::$_instance) {
            $route_params = request()->route()->parameters();
            self::$_instance = new self($route_params);
        }

        return self::$_instance;
    }

    /*
    public function test() {
        return static::$panel;
    }
    */
    public static function setRequestPanel(?PanelContract $panel): void {
        $inst = self::getInstance();
        $inst::$panel = $panel;
    }

    public static function getRequestPanel(): ?PanelContract {
        $inst = self::getInstance();
        try {
            return $inst::$panel;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * @param Model|ModelContract|UserContract $model
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \ReflectionException
     */
    public static function get(Model $model): PanelContract {
        $panel = self::setModel($model)->panel();
        $post_type = $panel->postType();
        $name = Str::plural($post_type);
        $panel->setName($name);

        return $panel;
    }

    /**
     * @param Model|ModelContract|UserContract $model
     */
    public static function setModel($model): self {
        self::$model = $model;

        return self::getInstance();
    }

    //ret \Illuminate\Contracts\Foundation\Application|mixed|null

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \ReflectionException
     */
    public static function panel(): PanelContract {
        if (! is_object(self::$model)) {
            //dddx(['model' => self::$model, 'message' => 'is not an object', 'url' => url()->current()]);
            //return null;
            throw new \Exception('model is not an object url:'.url()->current());
        }
        $class_full = get_class(self::$model);
        $class_name = class_basename(self::$model);
        //$class = Str::before($class_full, $class_name);
        $class = substr($class_full, 0, -strlen($class_name));
        $panel_class = $class.'Panels\\'.$class_name.'Panel';
        //*
        if (! class_exists($panel_class)) {
            $tmp = StubService::getByModel(self::$model, 'panel', $create = true);
        }
        //*/
        try {
            //self::$panel = new $panel_class(self::$model);
            self::$panel = app($panel_class);
            self::$panel->setRow(self::$model);
        } catch (\Exception $e) {
            echo '<h1 style="color:darkred">'.($e->getMessage()).'</h1>';
            $tmp = StubService::getByModel(self::$model, 'panel', $create = true);
        }

        if (null == self::$panel) {
            throw new \Exception('panel is null');
        }

        return self::$panel;
    }

    public function imageHtml(?array $params): string {
        return optional(self::$model)->image_src;
    }

    public function tabs(): array {
        return self::panel()->tabs();
    }

    //esempio parametro stringa 'area-1-menu-1'
    //rilascia il pannello dell'ultimo container (nell'esempio menu),
    //con parent il pannello del precedente container (nell'esempio area)
    public static function getById(string $id) {
        $piece = explode('-', $id);
        $route_params = [];
        $j = 0;
        for ($i = 0; $i < count($piece); ++$i) {
            if (0 == $i % 2) {
                $route_params['container'.$j] = $piece[$i];
            } else {
                $route_params['item'.$j] = $piece[$i];
                ++$j;
            }
        }
        //[$containers, $items] = params2ContainerItem($route_params);
        //dddx([$route_params, $containers, $items]);
        $route_params['in_admin'] = true;

        return self::getByParams($route_params);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\Response|mixed|null
     */
    public static function getByParams(?array $route_params) {
        [$containers, $items] = params2ContainerItem($route_params);
        $in_admin = null;
        if (isset($route_params['in_admin'])) {
            $in_admin = $route_params['in_admin'];
        }
        if (0 == count($containers)) {
            PanelService::setRequestPanel(null);

            return null;
        }

        $first_container = $containers[0];
        $row = TenantService::model($containers[0]);
        try {
            $panel = PanelService::get($row);
        } catch (\Exception $e) {
            $data = [
                'message' => $e->getMessage(),
                'lang' => \App::getLocale(),
                'e' => $e,
                'params' => $route_params,
            ];

            return response()->view('pub_theme::errors.404', $data, 404);
        }
        $panel->setRows($row);
        $panel->setName($first_container);
        $i = 0;
        if (isset($items[0])) {
            $panel->in_admin = $in_admin;
            $panel->setItem($items[0]);
            if (null == $panel->row) {
                $data = [
                    'message' => 'Not Found ['.$items[$i].'] on ['.$containers[$i].']',
                ];

                return response()->view('pub_theme::errors.404', $data, 404);
            }
            //dddx(['riga 108', $panel, $in_admin, $panel->in_admin, $route_params, params2ContainerItem($route_params)]);
        }
        $panel_parent = $panel;

        for ($i = 1; $i < count($containers); ++$i) {
            $row_prev = $panel_parent->row;
            $types = $containers[$i];
            //$types=Str::plural($types);
            $types = Str::camel($types);
            try {
                $rows = $row_prev->{$types}();
            } catch (\Exception $e) {
                $data = [
                    'message' => $e->getMessage(),
                    'lang' => \App::getLocale(),
                    'params' => $route_params,
                ];

                return response()->view('pub_theme::errors.404', $data, 404);
            } catch (\Error $e) {
                //return response("User can't perform this action.", 404);
                $data = [
                    'message' => $e->getMessage(),
                    'lang' => \App::getLocale(),
                    'params' => $route_params,
                ];

                return response()->view('pub_theme::errors.404', $data, 404);
            }
            $row = $rows->getRelated();

            $panel = PanelService::get($row);
            $panel->setRows($rows);
            $panel->setName($types);
            $panel->setParent($panel_parent);

            if (isset($items[$i])) {
                $panel->in_admin = $in_admin;
                $panel->setItem($items[$i]);
                if (null == $panel->row) {
                    $data = [
                        'message' => 'Not Found ['.$items[$i].'] on ['.$containers[$i].']',
                    ];

                    return response()->view('pub_theme::errors.404', $data, 404);
                }
                //dddx(['riga 143', $panel, $in_admin, $panel->in_admin, $route_params, params2ContainerItem($route_params)]);
            }
            $panel_parent = $panel;
        }

        return $panel;
    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \ReflectionException
     *
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public static function getByModel(ModelContract $model) {
        $class_full = get_class($model);
        $class_name = class_basename($model);
        $class = Str::before($class_full, $class_name);
        $panel = $class.'Panels\\'.$class_name.'Panel';
        if (class_exists($panel)) {
            if (! method_exists($panel, 'tabs')) {
                self::updatePanel(['panel' => $panel, 'func' => 'tabs']);
            }

            return new $panel();
        }
        self::createPanel($model);
        \Session::flash('status', 'panel created');

        return redirect()->back();
    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \ReflectionException
     */
    public static function createPanel(ModelContract $model): void {
        if (! is_object($model)) {
            dddx(['da fare']);
        }
        $class_full = get_class($model);
        $class_name = class_basename($model);
        $class = Str::before($class_full, $class_name);
        $panel_namespace = $class.'Panels';
        $panel = $panel_namespace.'\\'.$class_name.'Panel';
        //---- creazione panel
        $autoloader_reflector = new \ReflectionClass($model);
        $class_filename = $autoloader_reflector->getFileName();
        if (false === $class_filename) {
            throw new \Exception('autoloader_reflector err');
        }
        $model_dir = dirname($class_filename); // /home/vagrant/code/htdocs/lara/multi/laravel/Modules/LU/Models
        $stub_file = __DIR__.'/../Console/stubs/panel.stub';
        $stub = File::get($stub_file);
        $search = [];
        $fillables = $model->getFillable();
        $fields = [];
        foreach ($fillables as $input_name) {
            try {
                $input_type = $model->getConnection()->getDoctrineColumn($model->getTable(), $input_name)->getType(); //->getName();
            } catch (\Exception $e) {
                $input_type = 'Text';
            }
            $tmp = new \stdClass();
            $tmp->type = (string) $input_type;
            $tmp->name = $input_name;
            $fields[] = $tmp;
        }
        $dummy_id = $model->getRouteKeyName();
        /*
        Call to function is_array() with string will always evaluate to false
        if (is_array($dummy_id)) {
            echo '<h3>not work with multiple keys</h3>';
            $dummy_id = var_export($dummy_id, true);
        }
        */
        $replace = [
            'DummyNamespace' => $panel_namespace,
            'DummyClass' => $class_name.'Panel',
            'DummyFullModel' => $class_full,
            'dummy_id' => $dummy_id,
            'dummy_title' => 'title', // prendo il primo campo stringa
            'dummy_search' => var_export($search, true),
            'dummy_fields' => var_export($fields, true),
        ];
        $stub = str_replace(array_keys($replace), array_values($replace), $stub);
        $panel_dir = $model_dir.'/Panels';
        File::makeDirectory($panel_dir, $mode = 0777, true, true);
        $panel_file = $panel_dir.'/'.$class_name.'Panel.php';
        File::put($panel_file, $stub);
    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \ReflectionException
     */
    public static function updatePanel(array $params = []): void {
        extract($params);
        if (! isset($func)) {
            dddx(['err' => 'func is missing']);

            return;
        }
        if (! isset($panel)) {
            dddx(['err' => 'panel is missing']);

            return;
        }
        $func_file = __DIR__.'/../Console/stubs/panels/'.$func.'.stub';
        $func_stub = File::get($func_file);
        $autoloader_reflector = new \ReflectionClass($panel);
        $panel_file = $autoloader_reflector->getFileName();
        if (false === $panel_file) {
            throw new \Exception('autoloader_reflector err');
        }

        $panel_stub = File::get($panel_file);
        $panel_stub = Str::replaceLast('}', $func_stub.chr(13).chr(10).'}', $panel_stub);
        File::put($panel_file, $panel_stub);
    }
}