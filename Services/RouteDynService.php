<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Illuminate\Support\Str;
use Route;

/**
 * Class RouteDynService.
 */
<<<<<<< HEAD
class RouteDynService {
=======
class RouteDynService
{
>>>>>>> 9472ad4 (first)
    protected static ?string $namespace_start = '';

    protected static ?string $curr = null;

<<<<<<< HEAD
    public static function getGroupOpts(array $v, ?string $namespace): array {
=======
    public static function getGroupOpts(array $v, ?string $namespace): array
    {
>>>>>>> 9472ad4 (first)
        $group_opts = [
            'prefix' => self::getPrefix($v, $namespace),
            'namespace' => self::getNamespace($v, $namespace),
            'as' => self::getAs($v, $namespace),
        ];

        return $group_opts;
    }

<<<<<<< HEAD
    // ret false|mixed|string|string[]

    public static function getPrefix(array $v, ?string $namespace): string {
        if (\in_array('prefix', array_keys($v), true)) {
            return $v['prefix'];
        }
        $prefix = mb_strtolower($v['name']);
        // /*
        $param_name = self::getParamName($v, $namespace);
        if ('' !== $param_name) {
=======
    //ret false|mixed|string|string[]

    public static function getPrefix(array $v, ?string $namespace): string
    {
        if (\in_array('prefix', \array_keys($v), true)) {
            return $v['prefix'];
        }
        $prefix = \mb_strtolower($v['name']);
        ///*
        $param_name = self::getParamName($v, $namespace);
        if ('' != $param_name) {
>>>>>>> 9472ad4 (first)
            /*
            Call to function is_array() with string will always evaluate to false.
            if (\is_array($param_name)) {
                return $prefix.'/{'.\implode('}/{', $param_name).'}';
            }
            */
            return $prefix.'/{'.$param_name.'}';
        }
<<<<<<< HEAD
        // */
=======
        //*/
>>>>>>> 9472ad4 (first)
        /*
        $params_name=self::getParamsName($v,$namespace);
        if($params_name!=[]){
        return $prefix.'/{'.implode('}/{',$params_name).'}';
        }
         */
        return $prefix;
    }

<<<<<<< HEAD
    public static function getAs(array $v, ?string $namespace): string {
        if (\in_array('as', array_keys($v), true)) {
            return $v['as'];
        }
        $as = (string) mb_strtolower($v['name']).'';
        $as = str_replace('/', '.', $as);
        $as = (string) preg_replace('/{.*}./', '', $as);

        $as = str_replace('{', '', $as);
        $as = str_replace('}', '', $as);
=======
    public static function getAs(array $v, ?string $namespace): string
    {
        if (\in_array('as', \array_keys($v), true)) {
            return $v['as'];
        }
        $as = (string) \mb_strtolower($v['name']).'';
        $as = \str_replace('/', '.', $as);
        $as = (string) \preg_replace('/{.*}./', '', $as);

        $as = \str_replace('{', '', $as);
        $as = \str_replace('}', '', $as);
>>>>>>> 9472ad4 (first)

        return $as.'.';
    }

<<<<<<< HEAD
    public static function getNamespace(array $v, ?string $namespace): ?string {
        if (\in_array('namespace', array_keys($v), true)) {
            return $v['namespace'];
        }
        // if($namespace!=null){
        $namespace = $v['name'];
        // }
        $namespace = str_replace('{', '', $namespace);
        $namespace = str_replace('}', '', $namespace);
        if ('' === $namespace) {
            return null;
        }
        if (\is_array($namespace)) {
=======
    public static function getNamespace(array $v, ?string $namespace): ?string
    {
        if (\in_array('namespace', \array_keys($v), true)) {
            return $v['namespace'];
        }
        //if($namespace!=null){
        $namespace = $v['name'];
        //}
        $namespace = \str_replace('{', '', $namespace);
        $namespace = \str_replace('}', '', $namespace);
        if ('' == $namespace) {
            return null;
        }
        if (is_array($namespace)) {
>>>>>>> 9472ad4 (first)
            throw new \Exception('namespace is array');
        }

        return Str::studly($namespace);
    }

<<<<<<< HEAD
    public static function getAct(array $v, ?string $namespace): string {
        if (\in_array('act', array_keys($v), true)) {
            return $v['act'];
        }
        $v['act'] = $v['name'];
        $v['act'] = preg_replace('/{.*}\//', '', $v['act']);
        if (null === $v['act']) {
            $v['act'] = '';
        }
        $v['act'] = str_replace('/', '_', $v['act']);
        if (! \is_string($v['act'])) {
            throw new \Exception('act is not a string');
        }
        $v['act'] = Str::camel($v['act']);
        $v['act'] = str_replace('{', '', $v['act']);
        $v['act'] = str_replace('}', '', $v['act']);
        // camel_case foo_bar  => fooBar
        // studly_case foo_bar => FooBar
        return Str::camel($v['act']);
    }

    public static function getParamName(array $v, ?string $namespace): string {
        if (\in_array('param_name', array_keys($v), true)) {
            return $v['param_name'];
        }
        $param_name = 'id_'.$v['name'];
        $param_name = str_replace('{', '', $param_name);
        $param_name = str_replace('}', '', $param_name);
        // $param_name=null;
        $param_name = mb_strtolower($param_name);
=======
    public static function getAct(array $v, ?string $namespace): string
    {
        if (\in_array('act', \array_keys($v), true)) {
            return $v['act'];
        }
        $v['act'] = $v['name'];
        $v['act'] = \preg_replace('/{.*}\//', '', $v['act']);
        if (null === $v['act']) {
            $v['act'] = '';
        }
        $v['act'] = \str_replace('/', '_', $v['act']);
        if (! is_string($v['act'])) {
            throw new \Exception('act is not a string');
        }
        $v['act'] = Str::camel($v['act']);
        $v['act'] = \str_replace('{', '', $v['act']);
        $v['act'] = \str_replace('}', '', $v['act']);
        //camel_case foo_bar  => fooBar
        //studly_case foo_bar => FooBar
        return Str::camel($v['act']);
    }

    public static function getParamName(array $v, ?string $namespace): string
    {
        if (\in_array('param_name', \array_keys($v), true)) {
            return $v['param_name'];
        }
        $param_name = 'id_'.$v['name'];
        $param_name = \str_replace('{', '', $param_name);
        $param_name = \str_replace('}', '', $param_name);
        //$param_name=null;
        $param_name = \mb_strtolower($param_name);
>>>>>>> 9472ad4 (first)

        return $param_name;
    }

    /**
     * @return array|false|string|string[]
     */
<<<<<<< HEAD
    public static function getParamsName(array $v, ?string $namespace) {
=======
    public static function getParamsName(array $v, ?string $namespace)
    {
>>>>>>> 9472ad4 (first)
        $param_name = self::getParamName($v, $namespace);
        /*
        Call to function is_array() with string will always evaluate to false.
        if (! \is_array($param_name)) {
            $params_name = [$param_name];
        } else {
            $params_name = $param_name;
        }
        */
        $params_name = [$param_name];

        return $params_name;
    }

<<<<<<< HEAD
    public static function getResourceOpts(array $v, ?string $namespace): array {
        $param_name = self::getParamName($v, $namespace);
        $params_name = self::getParamsName($v, $namespace);
        if (! \is_array($params_name)) {
            throw new \Exception('params_name is not an array');
        }
        $opts = [
            'parameters' => [(string) mb_strtolower($v['name']) => implode('}/{', $params_name)],
=======
    public static function getResourceOpts(array $v, ?string $namespace): array
    {
        $param_name = self::getParamName($v, $namespace);
        $params_name = self::getParamsName($v, $namespace);
        if (! is_array($params_name)) {
            throw new \Exception('params_name is not an array');
        }
        $opts = [
            'parameters' => [(string) \mb_strtolower($v['name']) => \implode('}/{', $params_name)],
>>>>>>> 9472ad4 (first)
            'names' => self::prefixedResourceNames(self::getAs($v, $namespace)),
        ];
        if (isset($v['only'])) {
            $opts['only'] = $v['only'];
        }
<<<<<<< HEAD
        if ('' === $param_name && ! isset($opts['only'])) {
=======
        if ('' == $param_name && ! isset($opts['only'])) {
>>>>>>> 9472ad4 (first)
            $opts['only'] = ['index'];
        }
        $where = [];
        foreach ($params_name as $pn) {
            $where[$pn] = '[0-9]+';
        }
<<<<<<< HEAD
        $opts['where'] = $where; // se c'e' "id_" di sicuro e' un numero
=======
        $opts['where'] = $where; //se c'e' "id_" di sicuro e' un numero
>>>>>>> 9472ad4 (first)

        return $opts;
    }

<<<<<<< HEAD
    public static function getController(array $v, ?string $namespace): string {
        if (\in_array('controller', array_keys($v), true)) {
            return $v['controller'];
        }
        $v['controller'] = $v['name'];
        $v['controller'] = str_replace('/', '_', $v['controller']);
        $v['controller'] = str_replace('{', '', $v['controller']);
        $v['controller'] = str_replace('}', '', $v['controller']);
        if (! \is_string($v['controller'])) {
=======
    public static function getController(array $v, ?string $namespace): string
    {
        if (\in_array('controller', \array_keys($v), true)) {
            return $v['controller'];
        }
        $v['controller'] = $v['name'];
        $v['controller'] = \str_replace('/', '_', $v['controller']);
        $v['controller'] = \str_replace('{', '', $v['controller']);
        $v['controller'] = \str_replace('}', '', $v['controller']);
        if (! is_string($v['controller'])) {
>>>>>>> 9472ad4 (first)
            throw new \Exception('controller is not a string');
        }

        $v['controller'] = Str::studly($v['controller']);
<<<<<<< HEAD
        // camel_case foo_bar  => fooBar
        // studly_case foo_bar => FooBar
=======
        //camel_case foo_bar  => fooBar
        //studly_case foo_bar => FooBar
>>>>>>> 9472ad4 (first)
        $v['controller'] = $v['controller'].'Controller';

        return $v['controller'];
    }

<<<<<<< HEAD
    public static function getUri(array $v, ?string $namespace): string {
        $uri = mb_strtolower($v['name']);
=======
    public static function getUri(array $v, ?string $namespace): string
    {
        $uri = \mb_strtolower($v['name']);
>>>>>>> 9472ad4 (first)
        /*
        $v['prefix']=self::getPrefix($v,$namespace);
        if(isset($v['prefix'])){ //------------ !!!!! da verificare che non faccia danni
        $uri=$v['prefix'].'/'.$uri;
        }
         */
        return $uri;
    }

<<<<<<< HEAD
    public static function getMethod(array $v, ?string $namespace): array {
        if (\in_array('method', array_keys($v), true)) {
=======
    public static function getMethod(array $v, ?string $namespace): array
    {
        if (\in_array('method', \array_keys($v), true)) {
>>>>>>> 9472ad4 (first)
            return $v['method'];
        }

        return ['get', 'post'];
    }

<<<<<<< HEAD
    public static function getUses(array $v, ?string $namespace): string {
=======
    public static function getUses(array $v, ?string $namespace): string
    {
>>>>>>> 9472ad4 (first)
        $controller = self::getController($v, $namespace);
        $act = self::getAct($v, $namespace);
        $uses = $controller.'@'.$act;

        return $uses;
    }

<<<<<<< HEAD
    public static function getCallback(array $v, ?string $namespace, ?string $curr): array {
        $as = Str::slug($v['name']); // !!!!!! test da controllare
        $uses = self::getUses($v, $namespace);
        if (null !== $curr) {
=======
    public static function getCallback(array $v, ?string $namespace, ?string $curr): array
    {
        $as = Str::slug($v['name']); //!!!!!! test da controllare
        $uses = self::getUses($v, $namespace);
        if (null != $curr) {
>>>>>>> 9472ad4 (first)
            $uses = '\\'.self::$namespace_start.'\\'.$curr.'\\'.$uses;
        } else {
            $uses = '\\'.self::$namespace_start.'\\'.$uses;
        }
        $callback = ['as' => $as, 'uses' => $uses];

        return $callback;
    }

<<<<<<< HEAD
    public static function dynamic_route(array $array, ?string $namespace = null, ?string $namespace_start = null, ?string $curr = null): void {
        if (null !== $namespace_start) {
=======
    public static function dynamic_route(array $array, ?string $namespace = null, ?string $namespace_start = null, ?string $curr = null): void
    {
        if (null != $namespace_start) {
>>>>>>> 9472ad4 (first)
            self::$namespace_start = $namespace_start;
        } /*
        if($curr!=null){
        static::$curr=$curr;
        }*/
<<<<<<< HEAD
        reset($array);
=======
        \reset($array);
>>>>>>> 9472ad4 (first)
        foreach ($array as $k => $v) {
            $group_opts = self::getGroupOpts($v, $namespace);
            $v['group_opts'] = $group_opts;
            self::createRouteResource($v, $namespace);
            Route::group(
                $group_opts, function () use ($v, $namespace, $curr) {
                    self::createRouteActs($v, $namespace, $curr);
                    self::createRouteSubs($v, $namespace, $curr);
                }
            );
<<<<<<< HEAD
        } // end foreach
    }

    // end function

    // --------------------------------------------------------------------------------

    public static function createRouteResource(array $v, ?string $namespace): void {
        if (null === $v['name']) {
=======
        } //end foreach
    }

    //end function

    //--------------------------------------------------------------------------------

    public static function createRouteResource(array $v, ?string $namespace): void
    {
        if (null == $v['name']) {
>>>>>>> 9472ad4 (first)
            return;
        }
        $opts = self::getResourceOpts($v, $namespace);
        $controller = self::getController($v, $namespace);
<<<<<<< HEAD
        $name = mb_strtolower($v['name']);
        Route::resource($name, $controller, $opts)
            // ->where(['container1' => "^((?!create|edit).)*$"])  //BadMethodCallException Method Illuminate\Routing\PendingResourceRegistration::where does not exist.
            //  ->middleware('manageContainer','container1')
        ; // ->where(['id_'.$v['name'] => '[0-9]+']);
=======
        $name = \mb_strtolower($v['name']);
        Route::resource($name, $controller, $opts)
            //->where(['container1' => "^((?!create|edit).)*$"])  //BadMethodCallException Method Illuminate\Routing\PendingResourceRegistration::where does not exist.
            //  ->middleware('manageContainer','container1')
        ; //->where(['id_'.$v['name'] => '[0-9]+']);
>>>>>>> 9472ad4 (first)
    }

    // ------------------------------------------------------------------------------

<<<<<<< HEAD
    public static function createRouteSubs(array $v, ?string $namespace, ?string $curr): void {
=======
    public static function createRouteSubs(array $v, ?string $namespace, ?string $curr): void
    {
>>>>>>> 9472ad4 (first)
        if (! isset($v['subs'])) {
            return;
        }
        $sub_namespace = self::getNamespace($v, $namespace);
        /*
        if(self::$curr==null){
        self::$curr=$sub_namespace;
        }else{
        if(self::$curr!=$sub_namespace){
        self::$curr=self::$curr.'\\'.$sub_namespace;
        }
        }
         */
<<<<<<< HEAD
        if (null === $curr) {
            $curr = $sub_namespace;
        } else {
            $piece = explode('\\', $curr);
            if (last($piece) !== $sub_namespace && $curr !== $sub_namespace) {
=======
        if (null == $curr) {
            $curr = $sub_namespace;
        } else {
            $piece = \explode('\\', $curr);
            if (last($piece) != $sub_namespace && $curr != $sub_namespace) {
>>>>>>> 9472ad4 (first)
                $curr .= '\\'.$sub_namespace;
            }
        }

        self::dynamic_route($v['subs'], $sub_namespace, null, $curr);
    }

<<<<<<< HEAD
    // ---------------------------------------------------

    public static function createRouteActs(array $v, ?string $namespace, ?string $curr): void {
        if (! isset($v['acts'])) {
            return;
        }
        reset($v['acts']);

        $controller = self::getController($v, $namespace);
        foreach ($v['acts'] as $k1 => $v1) {
            // try {
                $v1['controller'] = $controller; // le acts hanno il controller del padre
            // } catch (\Exception $e) {
=======
    //---------------------------------------------------

    public static function createRouteActs(array $v, ?string $namespace, ?string $curr): void
    {
        if (! isset($v['acts'])) {
            return;
        }
        \reset($v['acts']);

        $controller = self::getController($v, $namespace);
        foreach ($v['acts'] as $k1 => $v1) {
            //try {
                $v1['controller'] = $controller; //le acts hanno il controller del padre
            //} catch (\Exception $e) {
>>>>>>> 9472ad4 (first)
            //    dddx([
            //        'message' => $e->getMessage(),
            //        'k1' => $k1,
            //        'v1' => $v1,
            //        'controller' => $controller,
            //    ]);
            // }
            $method = self::getMethod($v1, $namespace);
            $uri = self::getUri($v1, $namespace);
            $callback = self::getCallback($v1, $namespace, $curr);
            /*
            Else branch is unreachable because previous condition is always true.
            if (\is_array($method)) {
                Route::match($method, $uri, $callback);
            } else {
                Route::$method($uri, $callback);
            }
            */
            Route::match($method, $uri, $callback);
<<<<<<< HEAD
        } // endforeach
=======
        } //endforeach
>>>>>>> 9472ad4 (first)
    }

    // /--------------------------------------------------------
    /* ?? deprecated ??
    public static function routes() {
        if ('' != \Request::path()) {
            $tmp = \explode('/', \Request::path());
            $tmp = \array_slice($tmp, 0, 2);
            $tmp = \implode('_', $tmp);
            //echo '<h3>tmp = '.$tmp.'</h3>';die();
            $filename = 'web_'.$tmp.'.php';

            $tmp = \debug_backtrace();
            dd($tmp[3]['class']);

            $filename_dir = __DIR__.\DIRECTORY_SEPARATOR.$filename;
            echo '<h3>tmp = '.$filename_dir.'</h3>';
            die();
            if (\file_exists($filename_dir)) {
                require $filename_dir;
            }
        }
    }
    */
<<<<<<< HEAD
    // end routes
    // ------------------------------------------------------------------

    public static function prefixedResourceNames(string $prefix): array {
        if ('.' === mb_substr($prefix, -1)) {
            $prefix = mb_substr($prefix, 0, -1);
        }
        //Strict comparison using === between null and non-empty-string will always evaluate to false.  
        //if ('' === $prefix || null === $prefix) {
        if ('' === $prefix ) {
            return ['index' => $prefix.'index', 'create' => $prefix.'create', 'store' => $prefix.'store', 'show' => $prefix.'show', 'edit' => $prefix.'edit', 'update' => $prefix.'update', 'destroy' => $prefix.'destroy'];
        }
        $prefix = mb_strtolower($prefix);
=======
    //end routes
    //------------------------------------------------------------------

    public static function prefixedResourceNames(string $prefix): array
    {
        if ('.' == \mb_substr($prefix, -1)) {
            $prefix = \mb_substr($prefix, 0, -1);
        }
        if ('' == $prefix || null == $prefix) {
            return ['index' => $prefix.'index', 'create' => $prefix.'create', 'store' => $prefix.'store', 'show' => $prefix.'show', 'edit' => $prefix.'edit', 'update' => $prefix.'update', 'destroy' => $prefix.'destroy'];
        }
        $prefix = \mb_strtolower($prefix);
>>>>>>> 9472ad4 (first)

        return ['index' => $prefix.'.index', 'create' => $prefix.'.create', 'store' => $prefix.'.store', 'show' => $prefix.'.show', 'edit' => $prefix.'.edit', 'update' => $prefix.'.update', 'destroy' => $prefix.'.destroy'];
    }

<<<<<<< HEAD
    // end prefixedResourceNames

    // --------------------------------------------------

    public static function getContainerActs(): array {
=======
    //end prefixedResourceNames

    //--------------------------------------------------

    public static function getContainerActs(): array
    {
>>>>>>> 9472ad4 (first)
        $cont_acts = [
            [
                'name' => 'Edit',
                'act' => 'indexEdit',
<<<<<<< HEAD
            ], // end act_n
            [
                'name' => 'Order',
                'act' => 'indexOrder',
            ], // end act_n
            [
                'name' => 'Attach',
                'act' => 'indexAttach',
            ], // end act_n
=======
            ], //end act_n
            [
                'name' => 'Order',
                'act' => 'indexOrder',
            ], //end act_n
            [
                'name' => 'Attach',
                'act' => 'indexAttach',
            ], //end act_n
>>>>>>> 9472ad4 (first)
        ];

        return $cont_acts;
    }

<<<<<<< HEAD
    public static function getItemActs(): array {
        $acts = [
            // ['name' => 'attach'], //end act_n
            ['name' => 'detach', 'method' => ['DELETE', 'GET']], // end act_n
            // ['name' => 'moveUp', 'method' => ['PUT', 'GET']],   // se uso "order" questi non mi servono
            // ['name' => 'moveDown', 'method' => ['PUT', 'GET']],
        ]; // end acts
=======
    public static function getItemActs(): array
    {
        $acts = [
            //['name' => 'attach'], //end act_n
            ['name' => 'detach', 'method' => ['DELETE', 'GET']], //end act_n
            //['name' => 'moveUp', 'method' => ['PUT', 'GET']],   // se uso "order" questi non mi servono
            //['name' => 'moveDown', 'method' => ['PUT', 'GET']],
        ]; //end acts
>>>>>>> 9472ad4 (first)

        return $acts;
    }

<<<<<<< HEAD
    public static function generate(int $n = 0): array {
=======
    public static function generate(int $n = 0): array
    {
>>>>>>> 9472ad4 (first)
        if ($n > 4) {
            return [];
        }

        return [
            [
                'name' => '{container'.$n.'}',
                'param_name' => '',
                'as' => 'container'.$n.'.index_',
                'acts' => self::getContainerActs(),
<<<<<<< HEAD
                // 'only'=>[],
=======
                //'only'=>[],
>>>>>>> 9472ad4 (first)
            ],
            [
                'name' => '{container'.$n.'}',
                'param_name' => 'item'.$n.'',
                'acts' => self::getItemActs(),
                'subs' => self::generate($n + 1),
            ],
        ];
    }

<<<<<<< HEAD
    // --------------------------------------------------
}
=======
    //--------------------------------------------------
}
>>>>>>> 9472ad4 (first)
