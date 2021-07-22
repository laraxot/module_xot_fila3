<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Exception;
//use Illuminate\Support\Facades\Storage;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Modules\Xot\Contracts\ModelContract;

/**
 * Class TenantService.
 */
class TenantService {
    //public static $panel;

    /*
    public function TenantService() {
        dddx('b');
    }
    */
    /*
    public function __construct(Panel $panel) {
        static::$panel = $panel;
    }
    */

    public static function getName(array $params = []): string {
        //$default = 'localhost';
        $default = env('APP_URL');

        $server_name = $default;
        if (isset($_SERVER['SERVER_NAME']) && '127.0.0.1' != $_SERVER['SERVER_NAME']) {
            $server_name = $_SERVER['SERVER_NAME'];
        }

        $server_name = \str_replace('www.', '', $server_name);
        if (is_array($server_name)) {
            $server_name = implode('', $server_name);
        }
        $server_name = (string) $server_name;
        $tmp = explode('.', $server_name);
        $subdomain = null;
        $domain = null;
        $ext = null;
        $n_tmp = count($tmp);
        switch ($n_tmp) {
            case 3: [$subdomain,$domain,$ext] = $tmp; break;
            case 2: [$domain,$ext] = $tmp; break;
        }

        if (null == $domain) {
            $server_name = \str_replace('.', '-', $server_name);
            $server_name = Str::slug($server_name);
        } else {
            $server_name = Str::slug($domain).'-'.$ext;
        }
        if (file_exists(base_path('config/'.$server_name)) && '' != $server_name) {
            if (null != $subdomain && file_exists(base_path('config/'.$server_name.'/'.$subdomain))) {
                return $server_name.'/'.$subdomain;
            }

            return $server_name;
        }
        /*
        {subdomain}.{domain}.{tld}
        [$subdomain] = explode('.', request()->getHost(), PHP_URL_HOST);
        dd([$subdomain, request()->getHost(), PHP_URL_HOST]);
        */
        $default = Str::after($default, '//');
        $default = str_replace('.', '-', $default);
        if (file_exists(base_path('config/'.$default)) && '' != $default) {
            return $default;
        }

        return 'localhost';
    }

    //end function

    public static function filePath(string $filename): string {
        $path = base_path('config/'.self::getName().'/'.$filename);
        $path = str_replace(['/', '\\'], [DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR], $path);

        return $path;
    }

    //end function

    /**
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public static function config(string $key) {
        if (in_admin() && Str::startsWith($key, 'xra.model')) {
            $module_name = \Request::segment(2);
            $models = getModuleModels($module_name);
            $original_conf = config('xra.model');
            if (! is_array($original_conf)) {
                $original_conf = [];
            }
            //$merge_conf = array_merge($original_conf, $models);
            $merge_conf = collect($original_conf)->merge($models)->all();

            \Config::set('xra.model', $merge_conf);

            return config($key);
        }

        $group = collect(explode('.', $key))->first();

        $original_conf = config($group);
        $tenant_name = self::getName();

        $extra_conf = config(str_replace('/', '.', $tenant_name).'.'.$group);

        if (! is_array($original_conf)) {
            $original_conf = [];
        }

        if (! is_array($extra_conf)) {
            $extra_conf = [];
        }

        //$merge_conf = array_merge($original_conf, $extra_conf); //_recursive
        $merge_conf = collect($original_conf)->merge($extra_conf)->all();

        Config::set($group, $merge_conf);

        return config($key);
    }

    /*
    public static function config(string $key) {
       $group = implode('.', array_slice(explode('.', $key), 0, 2));


       if (in_admin() && Str::startsWith($key, 'xra.model')) {
           $module_name = \Request::segment(2);
           $models = getModuleModels($module_name);
           $original_conf = config('xra.model');
           if (! is_array($original_conf)) {
               $original_conf = [];
           }
           $merge_conf = array_merge($original_conf, $models);
           \Config::set('xra.model', $merge_conf);
       }

       $tenant_name = self::getName();
       $extra_conf = config(str_replace('/', '.', $tenant_name).'.'.$group); // ...

       $original_conf = config($group);

       if (! is_array($original_conf)) {
           $original_conf = [];
       }
       if (! is_array($extra_conf)) {
           $extra_conf = [$extra_conf];
       }
       $merge_conf = array_merge($original_conf, $extra_conf); //_recursive

       Config::set($group, $merge_conf);  // non so se metterlo ..

       return config($key);
    }
    */

    public static function saveConfig(array $params): void {
        $name = 'xra';
        $data = [];
        extract($params);
        $tennant_name = self::getName();
        $config_name = $tennant_name.'.'.$name;
        $config_data = config($config_name);
        //$config_data = array_merge_recursive($config_data, $data);
        if (! is_array($config_data)) {
            /*
            $msg = [
                'config_data' => $config_data,
                'config_name' => $config_name,
            ];
            dddx($msg);
            */
            $config_name = str_replace('/', '.', $config_name);
            $config_data = config($config_name);
        }

        $config_data = array_merge_recursive_distinct($config_data, $data); //funzione in helper

        $config_data = Arr::sortRecursive($config_data);
        /*
        $path = config_path($tennant_name.'/'.$name.'.php');
        $path = str_replace(['\\', '/'], [DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR], $path);
        */
        $path = self::filePath($name.'.php');
        $content = '<'.'?'.'php'.chr(13).chr(13).' return '.var_export($config_data, true).';';
        $content = str_replace('\\\\', '\\', $content);

        File::put($path.'', $content);
    }

    /**
     * @throws \ReflectionException
     *
     * @return ModelContract|Model
     */
    public static function model(string $name) {
        $name = Str::singular($name);
        $name = Str::snake($name);
        $class = self::config('xra.model.'.$name);
        if ('' == $class) {
            $models = getAllModulesModels();
            if (! isset($models[$name])) {
                throw new Exception('model unknown ['.$name.']');
            }
            $class = $models[$name];
            $data = [];
            $data['model'][$name] = $class;
            self::saveConfig(['name' => 'xra', 'data' => $data]);
        }
        //$model = app($class);
        if (! is_string($class)) {
            if (is_array($class)) {
                return $class[0];
            }
            dddx(
                [
                    'name' => $name,
                    'class' => $class,
                ]
            );
        }
        $model = new $class();

        return $model;
    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \ReflectionException
     */
    public static function modelEager(string $name): \Illuminate\Database\Eloquent\Builder {
        $model = self::model($name);
        if (null == $model) {
            //return null;
            throw new \Exception('model is null');
        }
        $panel = PanelService::get($model);
        if (null == $panel) {
            //return null;
            throw new \Exception('panel is null');
        }
        $with = $panel->with();
        //$model = $model->load($with);
        $model = $model->with($with);

        return $model;
    }
}
