<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Doctrine\DBAL\Schema\Column;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * Class StubService.
 */
class StubService {
    //-- model (object) or class (string)
    //-- stub_name name of stub
    //-- create yes or not
    private static ?self $_instance = null;

    //public ?Model $model;

    public string $model_class;

    public string $name;

    /**
     * getInstance.
     *
     * this method will return instance of the class
     */
    public static function getInstance() {
        if (! self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public static function setName(string $name): self {
        $instance = self::getInstance();
        $instance->name = $name;

        return $instance;
    }

    public static function setModel(Model $model): self {
        $instance = self::getInstance();
        $instance->model_class = get_class($model);

        return $instance;
    }

    public static function setModelClass(string $model_class): self {
        $instance = self::getInstance();
        $instance->model_class = $model_class;

        return $instance;
    }

    public static function setModelAndName(Model $model, string $name): self {
        $instance = self::getInstance();
        $instance->setModel($model);
        $instance->setName($name);

        return $instance;
    }

    public function get() {
        $file = $this->getClassFile();
        $class = $this->getClass();
        if (File::exists($file)) {
            return $class;
        }
        $this->generate();

        return $class;
    }

    public function getNamespace(): string {
        $ns = dirname($this->getClass());
        if (Str::startsWith($ns, '\\')) {
            $ns = Str::after($ns, '\\');
        }

        return $ns;
    }

    public function getModel(): Model {
        return app($this->model_class);
    }

    public function getReplaces(): array {
        $dummy_id = 'id';
        $search = [];
        $fields = [];
        if (class_exists($this->model_class)) {
            $model = $this->getModel();
            $fields = self::fields($model);

            $dummy_id = $model->getRouteKeyName();
        }
        /*
        dddx(
            [
                'fillable' => $this->getFillable(),
                'columns' => $this->getColumns(),
                'factories' => $this->getFactories(),
            ]
        );
        */
        //$columns = $this->getColumns();
        //dddx($columns);
        //$factories = $this->getFactories();
        //dddx($factories);
        $dummy_class = basename($this->getClass());
        $replaces = [
            'DummyNamespace' => $this->getNamespace(),
            'DummyClassLower' => strtolower($dummy_class),
            'DummyClass' => $dummy_class,
            'DummyModelClass' => basename($this->model_class),
            'DummyFullModel' => $this->getClass(),
            'dummy_id' => $dummy_id,
            'dummy_title' => 'title', // prendo il primo campo stringa
            'dummy_search' => var_export($search, true),
            'dummy_fields' => var_export($fields, true),
            'dummy_factories' => $this->getFactories(),
            'NamespacedDummyUserModel' => 'Modules\LU\Models\User',
            'NamespacedDummyModel' => $this->model_class,
        ];

        return $replaces;
    }

    public function getFactories(): string {
        if (! class_exists($this->model_class)) {
            return '';
        }

        return $this->getColumns()
            ->map(
                function (Column $column) {
                    return $this->mapTableProperties($column);
                    //return $this->getPropertiesFromMethods();
                }
            )->collapse()
            ->values()
            ->implode(',
            ')
            ;
    }

    /**
     * Maps properties.
     */
    protected function mapTableProperties(Column $column): array {
        $key = $column->getName();
        /*
        if (! $this->shouldBeIncluded($column)) {
            return $this->mapToFactory($key);
        }
        */
        /*
        if ($column->isForeignKey()) {
            return $this->mapToFactory(
                $key,
                $this->buildRelationFunction($key)
            );
        }
        */

        if ('password' === $key) {
            return $this->mapToFactory($key, "Hash::make('password')");
        }

        /*
        $value = $column->isUnique()
            ? '$this->faker->unique()->'
            : '$this->faker->';
        */
        $value = '$this->faker->';

        return $this->mapToFactory($key, $value.$this->mapToFaker($column));
    }

    /**
     * Checks if a given column should be included in the factory.
     */
    protected function shouldBeIncluded(Column $column) {
        $shouldBeIncluded = ($column->getNotNull() /*|| $this->includeNullableColumns */)
            && ! $column->getAutoincrement();

        if (! $this->getModel()->usesTimestamps()) {
            return $shouldBeIncluded;
        }

        $timestamps = [
            $this->getModel()->getCreatedAtColumn(),
            $this->getModel()->getUpdatedAtColumn(),
        ];

        if (method_exists($this->getModel(), 'getDeletedAtColumn')) {
            $timestamps[] = $this->getModel()->getDeletedAtColumn();
        }

        return $shouldBeIncluded
            && ! in_array($column->getName(), $timestamps);
    }

    protected function mapToFactory($key, $value = null): array {
        return [
            $key => is_null($value) ? $value : "'{$key}' => $value",
        ];
    }

    /**
     * Map name to faker method.
     *
     * @return string
     */
    protected function mapToFaker(Column $column) {
        return app(TypeGuesser::class)->guess(
            $column->getName(),
            $column->getType(),
            $column->getLength()
        );
    }

    public function getFillable(): \Illuminate\Support\Collection {
        $model = $this->getModel();
        if (! method_exists($model, 'getFillable')) {
            return [];
        }
        $fillables = $model->getFillable();
        if (0 == count($fillables)) {
            $fillables = $model->getConnection()->getSchemaBuilder()->getColumnListing($model->getTable());
        }

        $fillables = collect($fillables)
            ->except([
                'created_at', 'updated_at', 'updated_by', 'created_by', 'deleted_at', 'deleted_by',
                'deleted_ip', 'created_ip', 'updated_ip',
            ]);

        return $fillables;
    }

    public function getColumns() {
        $model = $this->getModel();
        $conn = $model->getConnection();
        $platform = $conn->getDoctrineSchemaManager()->getDatabasePlatform();
        $platform->registerDoctrineTypeMapping('enum', 'string');

        return $this->getFillable()->map(
            function ($input_name) use ($conn, $model) {
                try {
                    $table_name = $conn->getTablePrefix().$model->getTable();

                    return $conn->getDoctrineColumn($table_name, $input_name);
                } catch (\Exception $e) {
                    $msg = 'message:['.$e->getMessage().']
                        file:['.$e->getFile().']
                        line:['.$e->getLine().']
                        caller:['.__LINE__.']['.basename(__FILE__).']
                        ';
                    throw new \Exception($msg);
                    /*
                    dddx([
                        'message' => $e->getMessage(),
                        'name' => $this->name,
                        'modelClass' => $this->model_class,
                        'methods' => get_class_methods($e),
                        'e' => $e,
                        'msg' => $msg,
                    ]);
                    */
                    //return null;
                }
            }
        );
    }

    /**
     * sarebbe create ma in maniera fluent.
     */
    public function generate() {
        $stub_file = __DIR__.'/../Console/stubs/'.$this->name.'.stub';
        $stub = File::get($stub_file);
        $replace = $this->getReplaces();
        /*
        dddx([
            'array_keys($replace),' => array_keys($replace),
            'replace' => $replace,
            'stub' => $stub,
            //'file' => $file,
        ]);
        //*/

        $stub = str_replace(
            array_keys($replace),
            array_values($replace),
            $stub
        );

        $file = $this->getClassFile();

        File::put($file, $stub);
        $msg = (' ['.$file.'] is under creating , refresh page');

        \Session::flash($msg);
    }

    public function getClassName(): string {
        return class_basename($this->model_class);
    }

    public function getDirModel(): string {
        if (class_exists($this->model_class)) {
            $autoloader_reflector = new \ReflectionClass($this->model_class);
            //dddx($autoloader_reflector);
            $class_file_name = $autoloader_reflector->getFileName();
            if (false === $class_file_name) {
                throw new \Exception('autoloader_reflector false');
            }

            return dirname($class_file_name);
        }
        $class = $this->model_class;

        if (Str::startsWith($class, '\\')) {
            $class = Str::after($class, '\\');
        }
        $path = base_path($class);

        return dirname($path);
    }

    public function getClass(): string {
        $dir = collect(explode('\\', $this->model_class))->slice(0, -1)->implode('\\');

        switch ($this->name) {
            case 'factory':
                return Str::replace('\Models\\', '\Database\Factories\\', $this->model_class).'Factory';
            case 'migration_morph_pivot':
                return '';
            case 'morph_pivot':
                return '';
            case 'repository':
                return Str::replace('\Models\\', '\Repositories\\', $this->model_class).'Repository';
            case 'transformer_collection':
                return Str::replace('\Models\\', '\Transformers\\', $this->model_class).'Collection';
            case 'transformer_resource':
                return Str::replace('\Models\\', '\Transformers\\', $this->model_class).'Resource';
            case 'policy':
                return $dir.'\\Policies\\'.class_basename($this->model_class).'Policy';
            case 'panel':
                return $dir.'\\Panels\\'.class_basename($this->model_class).'Panel';
            case 'model':
                return $this->model_class;
            default:
                $msg = '['.$this->name.'] Unkwon !['.__LINE__.']['.basename(__FILE__).']';
                //dddx($msg);
                throw new \Exception($msg);
        }
    }

    public function getClassFile(): string {
        $class_name = $this->getClassName();
        $dir = $this->getDirModel();
        /*
        dddx([
            'class_name' => $class_name, //Comment
            'dir' => $dir,              //F:\var\www\base_ptvx\laravel\Modules\Blog\Models
        ]);
        */
        switch ($this->name) {
            case 'factory':
                return $dir.'/../Database/Factories/'.$class_name.'Factory.php';

            case 'migration_morph_pivot':
                return $dir.'/../Database/Migrations/'.date('Y_m_d_Hi00').'_create_'.Str::snake($class_name).'_table.php';

            case 'morph_pivot':
                return $dir.'/'.$class_name.'Morph.php';

            case 'repository':
                return $dir.'/../Repositories/'.$class_name.'Repository.php';

            case 'transformer_collection':
                return $dir.'/../Transformers/'.$class_name.'Collection.php';

            case 'transformer_resource':
                return $dir.'/../Transformers/'.$class_name.'Resource.php';
            case 'policy':
                return $dir.'/Policies/'.$class_name.'Policy.php';
            case 'panel':
                return $dir.'/Panels/'.$class_name.'Panel.php';
            case 'model':
                return $dir.'/'.$class_name.'.php';
            default:
                $msg = '['.$this->name.'] Unkwon !['.__LINE__.']['.basename(__FILE__).']';
                throw new \Exception($msg);
        }
    }

    /**
     * @param Model $model
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public static function fields($model): array {
        if (! method_exists($model, 'getFillable')) {
            return [];
        }
        $fillables = $model->getFillable();
        //dddx($fillables);

        if (count($fillables) <= 1) {
            $fillables = $model->getConnection()->getSchemaBuilder()->getColumnListing($model->getTable());
            $fillables = collect($fillables)->except([
                'created_at', 'updated_at', 'updated_by', 'created_by', 'deleted_at', 'deleted_by',
                'deleted_ip', 'created_ip', 'updated_ip',
            ])->all();
            $autoloader_reflector = new \ReflectionClass($model);
            $class_filename = $autoloader_reflector->getFileName();
            if (false === $class_filename) {
                throw new \Exception('autoloader_reflector err');
            }
            $fillables_str = chr(13).chr(10).'    protected $fillable=[\''.implode("','", $fillables)."'];".chr(13).chr(10);
            $class_content = File::get($class_filename);
            $class_content_before = Str::before($class_content, '{');
            $class_content_after = Str::after($class_content, '{');
            $class_content_new = $class_content_before.'{'.$fillables_str.$class_content_after;
            File::put($class_filename, $class_content_new);
        }
        $fields = [];
        foreach ($fillables as $input_name) {
            $tmp = new \stdClass();
            try {
                $col = $model->getConnection()->getDoctrineColumn($model->getTable(), $input_name); //->getType();//->getName();
                //dddx(get_class_methods($col->getType()));
                $type = $col->getType();
                /*
                dddx([
                    //$type->getSQLDeclaration(),
                    //$type->getType(),
                    $type->getTypesMap(),
                    $type->getName(),
                    $type->getTypeRegistry(),
                    $type->getBindingType(),
                    //$type->getMappedDatabaseTypes(),
                ]);
                */
                if ($col->getAutoincrement()) {
                    $tmp->type = 'Id';
                } else {
                    $tmp->type = Str::studly($col->getType()->getName());
                    $tmp->type = str_replace('\\', '', $tmp->type);
                }
                $tmp->name = $input_name;
                if ($col->getNotnull() && ! $col->getAutoincrement()) {
                    $tmp->rules = 'required';
                }
                $tmp->comment = $col->getComment();
            } catch (\Exception $e) {
                //$input_type='Text';
                //$tmp=new \stdClass();
                $tmp->type = 'Text';
                $tmp->name = $input_name;
                $tmp->comment = 'not in Doctrine';
            }

            $fields[] = $tmp;
            //debug_getter_obj(['obj'=>$col]);
            /*
            #_type: IntegerType {#983}
            #_length: null
            #_precision: 10
            #_scale: 0
            #_unsigned: true
            #_fixed: false
            #_notnull: true
            #_default: null
            #_autoincrement: true
            #_platformOptions: []
            #_columnDefinition: null
            #_comment: null
            #_customSchemaOptions: []
            #_name: "id"
            #_namespace: null
            #_quoted: false
             */

            /*
        $tmp=new \stdClass();
        $tmp->type=(string)$input_type;
        $tmp->name=$input_name;
        $fields[]=$tmp;
         */
        }

        return $fields;
    }
}
