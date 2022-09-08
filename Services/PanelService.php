<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
<<<<<<< HEAD
=======
use Modules\Tenant\Services\TenantService;
>>>>>>> 9472ad4 (first)
use Modules\Xot\Contracts\PanelContract;
use Modules\Xot\Contracts\UserContract;
use Modules\Xot\Relations\CustomRelation;
use Nwidart\Modules\Facades\Module;

/**
 * Class PanelService.
 */
class PanelService {
<<<<<<< HEAD
    // private static ?PanelService $_instance = null;
=======
    //private static ?PanelService $_instance = null;
>>>>>>> 9472ad4 (first)

    private Model $model;

    private ?PanelContract $panel = null;

    private static ?self $instance = null;

    public function __construct() {
<<<<<<< HEAD
        // ---
=======
        //---
>>>>>>> 9472ad4 (first)
    }

    public static function getInstance(): self {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function make(): self {
        return static::getInstance();
    }

<<<<<<< HEAD
    // 26     Property Modules\Xot\Services\PanelService::make()->$route_params is never read, only written.
    // private static array $route_params;
=======
    //26     Property Modules\Xot\Services\PanelService::make()->$route_params is never read, only written.
    //private static array $route_params;
>>>>>>> 9472ad4 (first)

    /*
    public function __construct($model){
    $this->model=$model;
    }
     */

<<<<<<< HEAD
    // public function __construct(array $route_params) {
    // $this->route_params = $route_params;
    // static::$panel = $this->getByRouteParams($route_params);
    // static::$route_params =  $route_params;
    // }

    // public static function getInstance(): self {
    //    if (null === self::$_instance) {
    // $route_params = request()->route()->parameters();// 42     Cannot call method parameters() on mixed.
=======
    //public function __construct(array $route_params) {
    //$this->route_params = $route_params;
    //static::$panel = $this->getByRouteParams($route_params);
    //static::$route_params =  $route_params;
    //}

    //public static function getInstance(): self {
    //    if (null === self::$_instance) {
    //$route_params = request()->route()->parameters();// 42     Cannot call method parameters() on mixed.
>>>>>>> 9472ad4 (first)
    //        $route_params = getRouteParameters();
    //        self::$_instance = new self($route_params);
    //    }

    //    return self::$_instance;
<<<<<<< HEAD
    // }
=======
    //}
>>>>>>> 9472ad4 (first)

    /*
    public function test() {
        return static::$panel;
    }
    */
    public function setRequestPanel(?PanelContract $panel): self {
        $this->panel = $panel;

        return $this;
    }

    public function getRequestPanel(): ?PanelContract {
        return $this->panel;
    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \ReflectionException
     */
    public function get(Model $model): PanelContract {
        $panel = $this->setModel($model)->panel();
        $post_type = $panel->postType();
<<<<<<< HEAD
        $name = Str::plural($post_type); // standard
        // $name = $post_type;
=======
        $name = Str::plural($post_type); //standard
        //$name = $post_type;
>>>>>>> 9472ad4 (first)
        $panel->setName($name);

        return $panel;
    }

    public function getByUser(UserContract $user): PanelContract {
        $model = $user->newInstance();

        return $this->get($model);
    }

    public function setModel(Model $model): self {
        $this->model = $model;

        return $this->getInstance();
    }

<<<<<<< HEAD
    // ret \Illuminate\Contracts\Foundation\Application|mixed|null
=======
    //ret \Illuminate\Contracts\Foundation\Application|mixed|null
>>>>>>> 9472ad4 (first)

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \ReflectionException
     */
    public function panel(): PanelContract {
<<<<<<< HEAD
        if (! \is_object($this->model)) {
=======
        if (! is_object($this->model)) {
>>>>>>> 9472ad4 (first)
            throw new \Exception('model is not an object url:'.url()->current());
        }
        /*
        $class_full = get_class($this->model);
        $class_name = class_basename($this->model);
        //$class = Str::before($class_full, $class_name);
        $class = substr($class_full, 0, -strlen($class_name));
        $panel_class = $class.'Panels\\'.$class_name.'Panel';

        if (! class_exists($panel_class)) {
            $tmp = StubService::getByModel($this->model, 'panel', $create = true);
        }

        return app($panel_class)->setRow($this->model);
        */
        $panel_class = StubService::make()->setModelAndName($this->model, 'panel')->get();

        return app($panel_class)
            ->setRow($this->model)
<<<<<<< HEAD
            // ->setRouteParams($this->route_params)
        ;
=======
            //->setRouteParams($this->route_params)
            ;
>>>>>>> 9472ad4 (first)
    }

    public function imageHtml(?array $params): string {
        $res = $this->model->getAttributeValue('image_src');
<<<<<<< HEAD
        if (! \is_string($res)) {
=======
        if (! is_string($res)) {
>>>>>>> 9472ad4 (first)
            throw new Exception('['.__LINE__.']['.class_basename(__CLASS__).']');
        }

        return $res;
    }

    public function tabs(): array {
        return $this->panel()->tabs();
    }

<<<<<<< HEAD
    // esempio parametro stringa 'area-1-menu-1'
    // rilascia il pannello dell'ultimo container (nell'esempio menu),
    // con parent il pannello del precedente container (nell'esempio area)
=======
    //esempio parametro stringa 'area-1-menu-1'
    //rilascia il pannello dell'ultimo container (nell'esempio menu),
    //con parent il pannello del precedente container (nell'esempio area)
>>>>>>> 9472ad4 (first)
    public function getById(string $id): PanelContract {
        $piece = explode('-', $id);
        $route_params = [];
        $j = 0;
<<<<<<< HEAD
        for ($i = 0; $i < \count($piece); ++$i) {
            if (0 === $i % 2) {
=======
        for ($i = 0; $i < count($piece); ++$i) {
            if (0 == $i % 2) {
>>>>>>> 9472ad4 (first)
                $route_params['container'.$j] = $piece[$i];
            } else {
                $route_params['item'.$j] = $piece[$i];
                ++$j;
            }
        }
<<<<<<< HEAD
        // [$containers, $items] = params2ContainerItem($route_params);
        // dddx([$route_params, $containers, $items]);
=======
        //[$containers, $items] = params2ContainerItem($route_params);
        //dddx([$route_params, $containers, $items]);
>>>>>>> 9472ad4 (first)
        $route_params['in_admin'] = true;

        return $this->getByParams($route_params);
    }

    public function getHomePanel(): PanelContract {
<<<<<<< HEAD
        /*
        $name = 'home';

        $model_class = config('morph_map.'.$name);
        if (null == $model_class || ! is_string($model_class) || ! class_exists($model_class)) {
            throw new Exception('['.$name.']['.__LINE__.']['.class_basename(__CLASS__).']');
        }
        $home = app($model_class);
        */
        $home = getModelByName('home');
=======
        $home = TenantService::model('home');

>>>>>>> 9472ad4 (first)
        $params = getRouteParameters();
        try {
            $home = $home->firstOrCreate(['id' => 1]);
        } catch (\Exception $e) {
            echo '<h3>'.$e->getMessage().'</h3>';
        }
        if (inAdmin() && isset($params['module'])) {
            $module = Module::find($params['module']);
<<<<<<< HEAD
            if (null === $module) {
=======
            if (null == $module) {
>>>>>>> 9472ad4 (first)
                throw new \Exception('module ['.$params['module'].'] not found');
            }
            $panel = '\Modules\\'.$module->getName().'\Models\Panels\_ModulePanel';
            $panel = app($panel);
            $panel->setRow($home);
            $panel->setName($params['module']);
        } else {
<<<<<<< HEAD
            $panel = self::make()->get($home);
            $panel->setName('home');
        }

        // ->firstOrCreate(['id' => 1]);
        // $panel = PanelService::make()->get($home);
=======
            $panel = PanelService::make()->get($home);
            $panel->setName('home');
        }

        //->firstOrCreate(['id' => 1]);
        //$panel = PanelService::make()->get($home);
>>>>>>> 9472ad4 (first)

        $rows = new CustomRelation(
            $home->newQuery(),
            $home,
            function ($relation): void {
                $relation->getQuery();
            },
            null,
            null
        );
        $panel->setRows($rows);

        return $panel;
    }

    /**
     * Function getByParams.
     */
    public function getByParams(?array $route_params): PanelContract {
        [$containers, $items] = params2ContainerItem($route_params);
        $in_admin = null;
        if (isset($route_params['in_admin'])) {
            $in_admin = $route_params['in_admin'];
        }
<<<<<<< HEAD
        if (null === $in_admin) {
            $in_admin = inAdmin();
        }

        if (0 === \count($containers)) {
=======
        if (null == $in_admin) {
            $in_admin = inAdmin();
        }

        if (0 == count($containers)) {
>>>>>>> 9472ad4 (first)
            $panel = $this->getHomePanel();

            return $panel;
        }

        $row = null;
<<<<<<< HEAD
        // $first_container = Str::singular($containers[0]);
        $first_container = $containers[0];
        if (isset($route_params['module'])) {
            $module_models = getModuleModels($route_params['module']);
            $model_class = collect($module_models)
                ->get($first_container);
            if (null == $model_class) {
                $model_class = collect($module_models)
                    ->get(Str::singular($first_container));
            }
            if (null !== $model_class) {
=======
        //$first_container = Str::singular($containers[0]);
        $first_container = $containers[0];
        if (isset($route_params['module'])) {
            $model_class = collect(getModuleModels($route_params['module']))
                ->get($first_container);
            if (null != $model_class) {
>>>>>>> 9472ad4 (first)
                $row = app($model_class);
            }
        }

        if (null === $row) {
<<<<<<< HEAD
            $row = getModelByName(Str::singular($first_container));
=======
            $row = TenantService::model($first_container);
>>>>>>> 9472ad4 (first)
        }

        $rows = new CustomRelation(
            $row->newQuery(),
<<<<<<< HEAD
            // $home_row,
=======
            //$home_row,
>>>>>>> 9472ad4 (first)
            $row,
            function ($relation): void {
                $relation->getQuery();
            },
            null,
            null
        );

<<<<<<< HEAD
        $panel = self::make()->get($row);

        $panel->setRows($rows);

        $panel->setName(Str::plural($first_container)); // / !!! da controllare
=======
        $panel = PanelService::make()->get($row);

        $panel->setRows($rows);

        $panel->setName(Str::plural($first_container)); /// !!! da controllare
>>>>>>> 9472ad4 (first)
        $i = 0;

        if (isset($items[0])) {
            $panel->setInAdmin($in_admin)->setItem($items[0]);
        }

        $panel_parent = $panel;

<<<<<<< HEAD
        for ($i = 1; $i < \count($containers); ++$i) {
            $row_prev = $panel_parent->getRow();
            $types = Str::camel($containers[$i]);
            // dddx([$row_prev, $panel_parent, $types]);
            $rows = $row_prev->{$types}(); // Relazione
            try {
                $row = $rows->getRelated(); // se relazione
            } catch (\Exception $e) {  // se builder
=======
        for ($i = 1; $i < count($containers); ++$i) {
            $row_prev = $panel_parent->getRow();
            $types = Str::camel($containers[$i]);
            //dddx([$row_prev, $panel_parent, $types]);
            $rows = $row_prev->{$types}(); //Relazione
            try {
                $row = $rows->getRelated(); //se relazione
            } catch (\Exception $e) {  //se builder
>>>>>>> 9472ad4 (first)
                /*
                dddx(
                    [
                        'message' => $e->getMessage(),
                        'rows' => $rows,
                        'get_class_methods' => get_class_methods($rows),
                        'model' => $rows->getModel(),
                    ]
                );
                */
                $row = $rows->getModel();
            }

<<<<<<< HEAD
            $panel = self::make()->get($row);
            // $rows = $rows->getQuery();
=======
            $panel = PanelService::make()->get($row);
            //$rows = $rows->getQuery();
>>>>>>> 9472ad4 (first)
            $panel->setRows($rows);
            $panel->setName($types);
            $panel->setParent($panel_parent);

            if (isset($items[$i])) {
                $panel->setInAdmin($in_admin)
                    ->setItem($items[$i]);
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
    public function getByModel(Model $model) {
<<<<<<< HEAD
        $class_full = \get_class($model);
=======
        $class_full = get_class($model);
>>>>>>> 9472ad4 (first)
        $class_name = class_basename($model);
        $class = Str::before($class_full, $class_name);
        $panel = $class.'Panels\\'.$class_name.'Panel';
        if (class_exists($panel)) {
            if (! method_exists($panel, 'tabs')) {
                $this->updatePanel(['panel' => $panel, 'func' => 'tabs']);
            }

            return new $panel();
        }
        $this->createPanel($model);
        \Session::flash('status', 'panel created');

        return redirect()->back();
    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \ReflectionException
     */
    public function createPanel(Model $model): void {
<<<<<<< HEAD
        $class_full = \get_class($model);
=======
        $class_full = get_class($model);
>>>>>>> 9472ad4 (first)
        $class_name = class_basename($model);
        $class = Str::before($class_full, $class_name);
        $panel_namespace = $class.'Panels';
        $panel = $panel_namespace.'\\'.$class_name.'Panel';
<<<<<<< HEAD
        // ---- creazione panel
=======
        //---- creazione panel
>>>>>>> 9472ad4 (first)
        $autoloader_reflector = new \ReflectionClass($model);
        $class_filename = $autoloader_reflector->getFileName();
        if (false === $class_filename) {
            throw new \Exception('autoloader_reflector err');
        }
<<<<<<< HEAD
        $model_dir = \dirname($class_filename); // /home/vagrant/code/htdocs/lara/multi/laravel/Modules/LU/Models
=======
        $model_dir = dirname($class_filename); // /home/vagrant/code/htdocs/lara/multi/laravel/Modules/LU/Models
>>>>>>> 9472ad4 (first)
        $stub_file = __DIR__.'/../Console/stubs/panel.stub';
        $stub = File::get($stub_file);
        $search = [];
        $fillables = $model->getFillable();
        $fields = [];
        foreach ($fillables as $input_name) {
            try {
                $input_type = $model->getConnection()->getDoctrineColumn($model->getTable(), $input_name)->getType()->getName();
            } catch (\Exception $e) {
                $input_type = 'Text';
            }
            $tmp = new \stdClass();
<<<<<<< HEAD
            // $tmp->type = (string) $input_type;// 311    Cannot cast 'Text'|Doctrine\DBAL\Types\Type to string.
=======
            //$tmp->type = (string) $input_type;// 311    Cannot cast 'Text'|Doctrine\DBAL\Types\Type to string.
>>>>>>> 9472ad4 (first)
            $tmp->type = $input_type;

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
    public function updatePanel(array $params = []): void {
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
<<<<<<< HEAD
        $panel_stub = Str::replaceLast('}', $func_stub.\chr(13).\chr(10).'}', $panel_stub);
=======
        $panel_stub = Str::replaceLast('}', $func_stub.chr(13).chr(10).'}', $panel_stub);
>>>>>>> 9472ad4 (first)
        File::put($panel_file, $panel_stub);
    }
}
