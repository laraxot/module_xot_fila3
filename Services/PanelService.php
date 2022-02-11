<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Modules\Tenant\Services\TenantService;
use Modules\Xot\Contracts\PanelContract;
use Modules\Xot\Contracts\UserContract;
use Modules\Xot\Relations\CustomRelation;
use Nwidart\Modules\Facades\Module;

/**
 * Class PanelService.
 */
class PanelService {
    private static ?PanelService $_instance = null;

    private static Model $model;

    private ?PanelContract $panel = null;

    //26     Property Modules\Xot\Services\PanelService::$route_params is never read, only written.
    private static array $route_params;

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
            //$route_params = request()->route()->parameters();// 42     Cannot call method parameters() on mixed.
            $route_params = getRouteParameters();
            self::$_instance = new self($route_params);
        }

        return self::$_instance;
    }

    /*
    public function test() {
        return static::$panel;
    }
    */
    public static function setRequestPanel(?PanelContract $panel): self {
        $inst = self::getInstance();
        $inst->panel = $panel;

        return $inst;
    }

    public static function getRequestPanel(): ?PanelContract {
        $inst = self::getInstance();

        return $inst->panel;
    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \ReflectionException
     */
    public static function get(Model $model): PanelContract {
        $panel = self::setModel($model)->panel();
        $post_type = $panel->postType();
        $name = Str::plural($post_type); //standard
        //$name = $post_type;
        $panel->setName($name);

        return $panel;
    }

    public static function getByUser(UserContract $user): PanelContract {
        $model = $user->newInstance();

        return self::get($model);
    }

    public static function setModel(Model $model): self {
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
            throw new \Exception('model is not an object url:'.url()->current());
        }
        /*
        $class_full = get_class(self::$model);
        $class_name = class_basename(self::$model);
        //$class = Str::before($class_full, $class_name);
        $class = substr($class_full, 0, -strlen($class_name));
        $panel_class = $class.'Panels\\'.$class_name.'Panel';

        if (! class_exists($panel_class)) {
            $tmp = StubService::getByModel(self::$model, 'panel', $create = true);
        }

        return app($panel_class)->setRow(self::$model);
        */
        $panel_class = StubService::setModelAndName(self::$model, 'panel')->get();

        return app($panel_class)
            ->setRow(self::$model)
            ->setRouteParams(self::$route_params);
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
    public static function getById(string $id): PanelContract {
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

    public static function getHomePanel(): PanelContract {
        $home = TenantService::model('home');

        $params = getRouteParameters();
        try {
            $home = $home->firstOrCreate(['id' => 1]);
        } catch (\Exception $e) {
            echo '<h3>'.$e->getMessage().'</h3>';
        }
        if (inAdmin() && isset($params['module'])) {
            $module = Module::find($params['module']);
            if (null == $module) {
                throw new \Exception('module ['.$params['module'].'] not found');
            }
            $panel = '\Modules\\'.$module->getName().'\Models\Panels\_ModulePanel';
            $panel = app($panel);
            $panel->setRow($home);
            $panel->setName($params['module']);
        } else {
            $panel = PanelService::get($home);
            $panel->setName('home');
        }

        //->firstOrCreate(['id' => 1]);
        //$panel = PanelService::get($home);

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
    public static function getByParams(?array $route_params): PanelContract {
        [$containers, $items] = params2ContainerItem($route_params);
        $in_admin = null;
        if (isset($route_params['in_admin'])) {
            $in_admin = $route_params['in_admin'];
        }
        if (null == $in_admin) {
            $in_admin = inAdmin();
        }

        if (0 == count($containers)) {
            $panel = self::getHomePanel();

            return $panel;
        }

        $row = null;
        $first_container = Str::singular($containers[0]);
        if (isset($route_params['module'])) {
            $model_class = collect(getModuleModels($route_params['module']))
                ->get($first_container);
            if (null != $model_class) {
                $row = app($model_class);
            }
        }

        if (null === $row) {
            $row = TenantService::model($first_container);
        }

        $rows = new CustomRelation(
            $row->newQuery(),
            //$home_row,
            $row,
            function ($relation): void {
                $relation->getQuery();
            },
            null,
            null
        );

        $panel = PanelService::get($row);

        $panel->setRows($rows);

        $panel->setName(Str::plural($first_container)); /// !!! da controllare
        $i = 0;

        if (isset($items[0])) {
            $panel->setInAdmin($in_admin)->setItem($items[0]);
        }

        $panel_parent = $panel;

        for ($i = 1; $i < count($containers); ++$i) {
            $row_prev = $panel_parent->getRow();
            $types = Str::camel($containers[$i]);
            //dddx([$row_prev, $panel_parent, $types]);
            $rows = $row_prev->{$types}(); //Relazione
            try {
                $row = $rows->getRelated(); //se relazione
            } catch (\Exception $e) {  //se builder
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

            $panel = PanelService::get($row);
            //$rows = $rows->getQuery();
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
    public static function getByModel(Model $model) {
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
    public static function createPanel(Model $model): void {
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
                $input_type = $model->getConnection()->getDoctrineColumn($model->getTable(), $input_name)->getType()->getName();
            } catch (\Exception $e) {
                $input_type = 'Text';
            }
            $tmp = new \stdClass();
            //$tmp->type = (string) $input_type;// 311    Cannot cast 'Text'|Doctrine\DBAL\Types\Type to string.
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
