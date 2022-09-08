<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Exception;
use Illuminate\Support\Facades\File;

/**
 * Class PolicyService.
 */
<<<<<<< HEAD
class PolicyService {
    private static ?PolicyService $instance = null;

    // protected static $obj;
=======
class PolicyService
{
    private static ?PolicyService $instance = null;

    //protected static $obj;
>>>>>>> 9472ad4 (first)

    protected static array $in_vars = [];

    protected static array $out_vars = [];

<<<<<<< HEAD
    public static function getInstance(): self {
=======
    public static function getInstance(): self
    {
>>>>>>> 9472ad4 (first)
        if (null === self::$instance) {
            self::$instance = new self();
        }
        /*
        if (null == self::$instance) {
            throw new \Exception('something gone bad');
        }
        */
        return self::$instance;
    }

    /**
     * @throws \ReflectionException
     */
<<<<<<< HEAD
    // ret PolicyService|null
    public static function get(object $obj): self {
        // self::$obj = $obj;
        $class = \get_class($obj);
        $class_name = class_basename($obj);
        $class_ns = substr($class, 0, -(\strlen($class_name) + 1));
=======
    //ret PolicyService|null
    public static function get(object $obj): self
    {
        //self::$obj = $obj;
        $class = get_class($obj);
        $class_name = class_basename($obj);
        $class_ns = substr($class, 0, -(strlen($class_name) + 1));
>>>>>>> 9472ad4 (first)

        self::$in_vars['class_name'] = $class_name;
        self::$in_vars['class_type'] = '';
        if ($obj instanceof \Modules\Xot\Models\Panels\XotBasePanel) {
            self::$in_vars['class_type'] = 'panel';
        }

        self::$in_vars['namespace'] = $class_ns;
        self::$in_vars['class'] = $class;
        $autoloader_reflector = new \ReflectionClass(self::$in_vars['class']);
        $filename = $autoloader_reflector->getFileName();
        if (false === $filename) {
            throw new Exception('autoloader_reflector error');
        }
<<<<<<< HEAD
        $filename = str_replace(['/', '\\'], [\DIRECTORY_SEPARATOR, \DIRECTORY_SEPARATOR], $filename);
        self::$in_vars['filename'] = $filename;
        self::$in_vars['dirname'] = \dirname(self::$in_vars['filename']);
=======
        $filename = str_replace(['/', '\\'], [DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR], $filename);
        self::$in_vars['filename'] = $filename;
        self::$in_vars['dirname'] = dirname(self::$in_vars['filename']);
>>>>>>> 9472ad4 (first)

        self::$out_vars['class_name'] = $class_name.'Policy';
        self::$out_vars['namespace'] = $class_ns.'\Policies';
        self::$out_vars['class'] = self::$out_vars['namespace'].'\\'.self::$out_vars['class_name'];
        $filename = self::$in_vars['dirname'].'/Policies/'.$class_name.'Policy.php';
<<<<<<< HEAD
        $filename = str_replace(['/', '\\'], [\DIRECTORY_SEPARATOR, \DIRECTORY_SEPARATOR], $filename);
        self::$out_vars['filename'] = $filename;
        self::$out_vars['dirname'] = \dirname(self::$out_vars['filename']);
=======
        $filename = str_replace(['/', '\\'], [DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR], $filename);
        self::$out_vars['filename'] = $filename;
        self::$out_vars['dirname'] = dirname(self::$out_vars['filename']);
>>>>>>> 9472ad4 (first)

        return self::getInstance();
    }

    /**
     * @return mixed
     */
<<<<<<< HEAD
    public function getClass() {
=======
    public function getClass()
    {
>>>>>>> 9472ad4 (first)
        return self::$out_vars['class'];
    }

    /**
     * @return bool
     */
<<<<<<< HEAD
    public function exists() {
        return File::exists(self::$out_vars['filename']);
    }

    public static function replaces(array $params = []): array {
=======
    public function exists()
    {
        return File::exists(self::$out_vars['filename']);
    }

    public static function replaces(array $params = []): array
    {
>>>>>>> 9472ad4 (first)
        extract(self::$out_vars);
        if (! isset($namespace)) {
            throw new Exception('namespace is missing');
        }
        if (! isset($class_name)) {
            throw new Exception('class_name is missing');
        }
        if (! isset($class)) {
            throw new Exception('class is missing');
        }

        $replaces = [
            'DummyNamespace' => $namespace,
            'DummyClass' => $class_name,
            'DummyFullModel' => $class,
<<<<<<< HEAD
            // 'dummy_id' => $dummy_id,
=======
            //'dummy_id' => $dummy_id,
>>>>>>> 9472ad4 (first)
            'dummy_title' => 'title', // prendo il primo campo stringa
            'NamespacedDummyUserModel' => 'Modules\LU\Models\User',
            'NamespacedDummyModel' => $class,
        ];

        return $replaces;
    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
<<<<<<< HEAD
    public function createIfNotExists(): self {
        if ($this->exists()) {
            return self::getInstance(); // se esiste esce;
        }
        $stub_name = 'policy';
        if ('' !== self::$in_vars['class_type']) {
=======
    public function createIfNotExists(): PolicyService
    {
        if ($this->exists()) {
            return self::getInstance(); //se esiste esce;
        }
        $stub_name = 'policy';
        if ('' != self::$in_vars['class_type']) {
>>>>>>> 9472ad4 (first)
            $stub_name .= '/'.self::$in_vars['class_type'];
        }
        $stub_file = __DIR__.'/../Console/stubs/'.$stub_name.'.stub';

        $stub = File::get($stub_file);

        $replace = self::replaces();
        $stub = str_replace(array_keys($replace), array_values($replace), $stub);

        File::makeDirectory(self::$out_vars['dirname'], $mode = 0777, true, true);

        if (! File::exists(self::$out_vars['filename'])) {
            File::put(self::$out_vars['filename'], $stub);
        } else {
            echo '<h3>['.self::$out_vars['filename'].'] Just exists</h3>';
            dddx(debug_backtrace());
        }

        $res = self::getInstance();

        return $res;
    }
}
