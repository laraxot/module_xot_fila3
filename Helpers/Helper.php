<?php

declare(strict_types=1);

// use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Modules\Tenant\Services\TenantService;
use Modules\Xot\Services\ArrayService;
use Modules\Xot\Services\FileService;
use Modules\Xot\Services\ModuleService;
use Modules\Xot\Services\PanelService;
use Modules\Xot\Services\RouteService;
use Nwidart\Modules\Facades\Module;

// ------------------------------------------------
if (! function_exists('snake_case')) {
    /**
     * @param string $str
     *
     * @return string
     */
    function snake_case($str) {
        return Str::snake($str);
    }
}

if (! function_exists('str_slug')) {
    /**
     * @param string $str
     *
     * @return string
     */
    function str_slug($str) {
        return Str::slug($str);
    }
}

if (! function_exists('str_singular')) {
    /**
     * @param string $str
     *
     * @return string
     */
    function str_singular($str) {
        return Str::singular($str);
    }
}

if (! function_exists('starts_with')) {
    /**
     * @param string $str
     * @param string $str1
     *
     * @return bool
     */
    function starts_with($str, $str1) {
        return Str::startsWith($str, $str1);
    }
}

if (! function_exists('ends_with')) {
    /**
     * @param string $str
     * @param string $str1
     *
     * @return bool
     */
    function ends_with($str, $str1) {
        return Str::endsWith($str, $str1);
    }
}

if (! function_exists('str_contains')) {
    /**
     * @param string $str
     * @param string $str1
     *
     * @return bool
     */
    function str_contains($str, $str1) {
        return Str::contains($str, $str1);
    }
}

// -------------------------------------------

if (! function_exists('backtrace')) {
    function filter_vendor(array $obj): bool {
        $tmp = str_replace('/', DIRECTORY_SEPARATOR, $obj['file']);
        if (is_array($tmp)) {
            $tmp = implode(' ', $tmp);
        }

        return false === strpos($tmp, 'vendor');
    }

    function backtrace(bool $exclude_vendor = false): void {
        $dbg_backtrace = debug_backtrace();

        if (true === $exclude_vendor) {
            $dbg_backtrace = array_filter($dbg_backtrace, 'filter_vendor');
        }

        dd(
            [
                $dbg_backtrace,
            ]
        );
    }
}

// --------------------------------------------
/*
if (! \function_exists('superdump')) {
    function superdump($params) {
        if (! is_array($params)) {
            $params = [$params];
        }
        echo '<br>-------------------------------------<br>';
        var_dump($params);
        echo '<br>-------------------------------------<br>';
    }
}
*/

if (! function_exists('dddx')) {
    /**
     * @param array|string|mixed $params
     *
     * @return string
     */
    function dddx($params) {
        $tmp = debug_backtrace();
        $file = $tmp[0]['file'] ?? 'file-unknown';
        $file = str_replace('/', DIRECTORY_SEPARATOR, $file);
        $doc_root = $_SERVER['DOCUMENT_ROOT'];
        $doc_root = str_replace('/', DIRECTORY_SEPARATOR, $doc_root);
        $dir_piece = explode(DIRECTORY_SEPARATOR, __DIR__);
        $dir_piece = array_slice($dir_piece, 0, -6);
        $dir_copy = implode(DIRECTORY_SEPARATOR, $dir_piece);
        $file = str_replace($dir_copy, $doc_root, $file);

        $data = [
            '_' => $params,
            'line' => $tmp[0]['line'] ?? 'line-unknows',
            'file' => FileService::fixPath($tmp[0]['file'] ?? 'file-unknown'),
            // 'file_1' => $file, //da sistemare
        ];
        if (File::exists($data['file']) && Str::startsWith($data['file'], FileService::fixPath(storage_path('framework/views')))) {
            // $data['extra'] = 'preso';
            $content = File::get($data['file']);
            $data['view_file'] = FileService::fixPath(Str::between($content, '/**PATH ', ' ENDPATH**/'));
        }
        dd(
            $data,
        );
    }
}

if (! function_exists('debug_methods')) {
    function debug_methods(object $rows): string {
        $methods = get_class_methods($rows);
        // *
        $methods_get = collect($methods)->filter(
            function ($item) {
                return Str::startsWith($item, 'get');
            }
        )->map(
            function ($item) use ($rows) {
                $value = 'Undefined';
                try {
                    $value = $rows->{$item}();
                } catch (\Exception $e) {
                    $value = $e->getMessage();
                } catch (ArgumentCountError $e) {
                    $value = $e->getMessage();
                }

                return [
                    'name' => $item,
                    'value' => $value,
                ];
            }
        )->all();

        return ArrayService::make()
            ->setArray($methods_get)
            ->toHtml();
    }
}

if (! function_exists('getFilename')) {
    /**
     * @return string
     */
    function getFilename(array $params) {
        $tmp = debug_backtrace();
        $class = (string) class_basename($tmp[1]['class'] ?? 'class-unknown');

        $func = (string) $tmp[1]['function'];
        $params_list = collect($params)->except(['_token', '_method'])->implode('_');
        $filename = Str::slug(
            (string) str_replace('Controller', '', $class).
                '_'.str_replace('do_', '', $func).
                '_'.$params_list
        );

        return $filename;
    }
}
if (! function_exists('req_uri')) {
    /**
     * @return mixed|string
     */
    function req_uri() {
        $req_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';

        return $req_uri;
    }
}

if (! function_exists('in_admin')) {
    /**
     * @return array|bool|mixed
     */
    function in_admin(array $params = []) {
        return inAdmin($params);
    }
}
if (! function_exists('inAdmin')) {
    /**
     * @return array|bool|mixed
     */
    function inAdmin(array $params = []) {
        return RouteService::inAdmin($params);
    }
}

/*
     * Return true if current page is home.
     *
     * @return bool
     */
if (! function_exists('isHome')) {
    /**
     * @return bool
     */
    function isHome() {
        if (URL::current() === url('')) {
            return true;
        }

        return Route::is('home');
    }
}
/*
     * Return true if current page is an admin home page.
     *
     * @return bool
     */
if (! function_exists('isAdminHome')) {
    /**
     * @return bool
     */
    function isAdminHome() {
        return URL::current() === route('admin.index');
    }
}

/*
     * https://gist.github.com/atorscho/5bcf63d077c11ed0e8ce
     * Return true if current page is an admin page.
     *
     * @return bool
     */
if (! function_exists('isAdmin')) {
    /**
     * @return bool
     */
    function isAdmin() {
        return Route::is('*admin*');
    }
}

/*
     * Replaces spaces with full text search wildcards
     *
     * @param string $term
     * @return string
     */
if (! function_exists('fullTextWildcards')) {
    /* protected */
    /**
     * @param string $term
     *
     * @return string
     */
    function fullTextWildcards($term) {
        // removing symbols used by MySQL
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $term = str_replace($reservedSymbols, '', $term);

        $words = explode(' ', $term);

        foreach ($words as $key => $word) {
            /*
             * applying + operator (required word) only big words
             * because smaller ones are not indexed by mysql
             */
            if (strlen($word) >= 3) {
                $words[$key] = '+'.$word.'*';
            }
        }

        $searchTerm = implode(' ', $words);

        return $searchTerm;
    }
}

if (! function_exists('isContainer')) {
    /**
     * @return bool
     */
    function isContainer() {
        [$containers, $items] = params2ContainerItem();

        return count($containers) > count($items);
    }
}
if (! function_exists('isItem')) {
    /**
     * @return bool
     */
    function isItem() {
        [$containers, $items] = params2ContainerItem();

        return count($containers) === count($items);
    }
}

if (! function_exists('params2ContainerItem')) {
    /**
     * @param array $params
     *
     * @return array[]
     */
    function params2ContainerItem(?array $params = null) {
        if (null === $params) {
            // Call to static method current() on an unknown class Route.
            // $params = optional(\Route::current())->parameters();
            // Cannot call method parameters() on mixed.
            // $params = optional(Route::current())->parameters();
            $params = [];
            $route_current = Route::current();
            if (null !== $route_current) {
                $params = $route_current->parameters();
            }
        }
        $container = [];
        $item = [];
        foreach ($params as $k => $v) {
            $pattern = '/(container|item)([0-9]+)/';
            preg_match($pattern, $k, $matches);
            if (isset($matches[1]) && isset($matches[2])) {
                $sk = $matches[1];
                $sv = $matches[2];
                $$sk[$sv] = $v;
            }
        }

        return [$container, $item];
    }
}

if (! function_exists('getModelFields')) {
    function getModelFields(Model $model): array {
        $fields = $model->getConnection()
            ->getSchemaBuilder()
            ->getColumnListing($model->getTable());

        return $fields;
    }
}

if (! function_exists('getModuleFromModel')) {
    /**
     * @param object $model
     *
     * @return mixed|\Nwidart\Modules\Module|void|null
     */
    function getModuleFromModel($model) {
        $class = get_class($model);
        $module_name = Str::before(Str::after($class, 'Modules\\'), '\\Models\\');
        // call to an undefined static method  Nwidart\Modules\Facades\Module::find().
        // $mod = Module::find($module_name);
        $mod = Module::get($module_name);

        return $mod;
    }
}

if (! function_exists('getModuleNameFromModel')) {
    function getModuleNameFromModel(object $model): string {
        if (! is_object($model)) {
            dddx(['model' => $model]);
            throw new \Exception('model is not an object');
        }
        $class = get_class($model);
        $module_name = Str::before(Str::after($class, 'Modules\\'), '\\Models\\');

        return $module_name;
    }
}

if (! function_exists('getModuleNameFromModelName')) {
    function getModuleNameFromModelName(string $model_name): string {
        $model = TenantService::model($model_name);

        return getModuleNameFromModel($model);
    }
}

if (! function_exists('getTransformerFromModel')) {
    /**
     * @param object $model
     * @param string $type
     *
     * @return mixed|string
     */
    function getTransformerFromModel($model, $type = 'Resource') {
        $class = get_class($model);
        $module_name = getModuleNameFromModel($model);
        $transformer = '\\Modules\\'.$module_name.'\Transformers\\'.class_basename($model).''.$type;
        // dddx($transformer.' '.class_exists($transformer));
        if (! class_exists($transformer)) {
            dddx('preso');
        }

        return $transformer;
    }
}

if (! function_exists('getAllModulesModels')) {
    /**
     * @throws ReflectionException
     *
     * @return array
     */
    function getAllModulesModels() {
        $res = [];
        $modules = Module::all();
        foreach ($modules as $module) {
            $tmp = getModuleModels($module->getName());
            $res = array_merge($res, $tmp);
        }

        return $res;
    }
}

if (! function_exists('getModuleModels')) {
    /**
     * @param string $module
     *
     * @throws ReflectionException
     *
     * @return array
     */
    function getModuleModels($module) {
        return ModuleService::make()->setName($module)->getModels();
    }
}

if (! function_exists('getModuleModelsMenu')) {
    function getModuleModelsMenu(string $module): Collection {
        $models = getModuleModels($module);
        $menu = collect($models)->map(
            function ($item, $key) {
                // $obj = new $item();
                $obj = app($item);
                $panel = PanelService::make()->get($obj);
                // *
                if ('media' === $key) {// media e' singolare ma anche plurale di medium
                    $panel->setName('medias');
                }
                // */
                $url = $panel->url('index');

                return (object) [
                    'title' => $key,
                    'url' => $url,
                    'active' => false,
                ];
            }
        );

        return $menu;
    }
}

if (! function_exists('xotModel')) {
    function xotModel(string $name): Model {
        return TenantService::model($name);
    }
}

if (! function_exists('xotModelEager')) {
    /**
     * @param string $name
     *
     * @return array|false|mixed
     */
    function xotModelEager($name) {
        return TenantService::modelEager($name);
    }
}

if (! function_exists('transFields')) {
    /**
     * @return mixed|stdClass
     */
    function transFields(array $params) {
        $params_orig = $params;
        if (! isset($params_orig['attributes'])) {
            $params_orig['attributes'] = [];
        }
        $name = 'not-set';
        // $model = Form::getModel();
        $model = \Collective\Html\FormFacade::getModel();
        $module_name = '';
        if (is_object($model)) {
            $module_name = getModuleNameFromModel($model);
        }

        $ns = Str::lower($module_name);
        $trans_root = $ns.'::'.Str::snake(class_basename($model));
        // debug_getter_obj(['obj'=>$module]);
        // dddx($module_name->getNamespace());
        $view = 'unknown';
        extract($params);
        // dddx($params);
        if (isset($attributes)) {
            extract($attributes);
        }
        if (isset($options['field'])) {
            $field = $options['field'];
            $ris = $field;
        } else {
            $ris = new \stdClass();
        }

        $start = 0;
        if (inAdmin()) {
            $start = 1;
        }
        if (! isset($ris->name)) {
            $ris->name = $name;
        }

        $ris->name_dot = bracketsToDotted((string) $name);

        $pattern = '/\.[0-9]+\./m';
        $ris->name_dot = preg_replace($pattern, '.', $ris->name_dot);
        if (! Str::contains($view, '::')) {
            $view = 'pub_theme::'.$view;
        }
        list($ns, $key) = explode('::', $view);
        if (null === $module_name) {
            $trans_root = $ns.'::'.implode('.', array_slice(explode('.', $key), $start, -1));
        }
        // *

        $trans_fields = ['label', 'placeholder', 'help'];
        foreach ($trans_fields as $tf) {
            $trans = $trans_root.'.field.'.Str::snake((string) $ris->name_dot).'.'.$tf;
            // if (! isset($ris->$tf)) {
            $ris->$tf = isset($$tf) ? $$tf : trans($trans);

            if ($ris->$tf === $trans && ! config('xra.show_trans_key')) {
                $ris->$tf = $ris->name_dot;
                // $ris->$tf = $trans;
            }
            // }
        }
        // */
        if ($ris->help === $ris->name_dot) {
            $ris->help = '';
        }

        $attributes = $params;
        $attrs_default = ['class' => 'form-control', 'placeholder' => $ris->placeholder];
        if (! isset($params['attributes'])) {
            $params['attributes'] = [];
        }
        $attributes = array_merge($attrs_default, $attributes, $params['attributes'], $params_orig['attributes']);
        /*
        if (! empty($params_orig['attributes'])) {
            dddx($attributes);
        }
        */
        $ris->attributes = collect($attributes)
            ->filter(
                function ($item, $key) {
                    return in_array($key, ['style', 'class', 'placeholder', 'readonly', 'id', 'value', 'name'], true) || Str::startsWith($key, 'data-');
                }
            )
            // ->only('class','placeholder','readonly')
            ->all();
        $ris->params = $params;

        if (! isset($ris->col_size)) {
            $ris->col_size = 12;
        }
        $row = \Form::getModel();

        $ris->value = (Arr::get($row, $name));

        return $ris;
    }
}

if (! function_exists('deltaTime')) {
    /**
     * @return mixed
     */
    function deltaTime() {
        echo '<h3>Time : '.(microtime(true) - LARAVEL_START).'</h3>';
    }
}

if (! function_exists('debug_getter_obj')) {
    /*
    function debug_getter_objOLD(array $params){
        extract($params);
        if (! isset($obj)) {
            dddx(['err' => 'obj is missing']);

            return null;
        }
        $methods = collect(get_class_methods($obj))->filter(function ($item) {
            $exclude = [
                //--Too few arguments to function
                'getRelationExistenceQuery',
                'getRelationExistenceQueryForSelfRelation',
                'getRelationExistenceCountQuery',
                'getMorphedModel',
                'getRelationExistenceQueryForSelfJoin',
                'getPlatformOption',
                'getCustomSchemaOption',
                'getShortestName',
                'getFullQualifiedName',
                'getQuotedName',
                //---
                'getAttribute',
                'getAttributeValue',
                'getRelationValue',
                'getGlobalScope',
                'getActualClassNameForMorph',
                'getRelation',
                //---------
                'getDataStartAttribute',
                'getDataAttribute',
                'getMacro',
                //--altri errori --
            ];

            return Str::startsWith($item, 'get') && ! in_array($item, $exclude);
        })->map(function ($item) use ($obj) {
            $tmp = [];
            $tmp['name'] = $item;
            try {
                $tmp['ris'] = $obj->$item();
            } catch (\Exception $e) {
                $tmp['ris'] = $e->getMessage();
            }

            return $tmp;
        });
        //->dd();
        $html = '<table border="1">
        <thead>
        <tr>
        <th>Name</th>
        <th>Ris</th>
        </tr>
        </thead>';
        foreach ($methods as $k => $v) {
            $html .= '<tr>';
            $html .= '<td>'.$v['name'].'</td>';
            $val = $v['ris'];
            if (is_object($val)) {
                $val = '(Object) '.get_class($val);
            }
            if (is_array($val)) {
                $val = var_export($val, true);
            }
            $html .= '<td>'.$val.'</td>';
            $html .= '</tr>';
        }
        $html .= '</table>';
        echo $html;
        dddx($methods);
    }//end function
    */

    /**
     * @throws ReflectionException
     *
     * @return array|null
     */
    function debug_getter_obj(array $params) {
        extract($params);
        if (! isset($obj)) {
            dddx(['err' => 'obj is missing']);

            return null;
        }
        $methods = get_class_methods($obj);
        $data = [];
        if (! is_array($methods)) {
            return $data;
        }
        $methods = collect($methods)->filter(
            function ($item) {
                $exclude = [
                    'forceDelete',
                    'forceCreate',
                ];
                if (! Str::startsWith($item, '__') && ! in_array($item, $exclude, true)) {
                    return true;
                }

                return false;
            }
        )->all();
        // dddx($methods);
        foreach ($methods as $method) {
            $reflection = new \ReflectionMethod($obj, $method);
            $args = $reflection->getParameters();
            if (0 === count($args) && $reflection->class === get_class($obj)) {
                try {
                    $return = $reflection->invoke($obj);
                    // $check = ($return instanceof \Illuminate\Database\Eloquent\Relations\Relation);
                    // if ($check) {
                    // $related_model = (new \ReflectionClass($return->getRelated()))->getName();
                    $msg = [
                        'name' => $reflection->name,
                        'type' => class_basename($return),
                        'ris' => $return,
                        // 'check'=>$check,
                        // $msg['type']=(new \ReflectionClass($return))->getShortName();
                        // 'model' => $related_model,
                    ];
                    $data[] = $msg;
                    // }
                } catch (ErrorException $e) {
                }
            }
        }
        dddx($data);

        return $data;
    }
} // end exists

if (! function_exists('bracketsToDotted')) {
    // privacies[111][pivot][title] => privacies.111.pivot.title

    function bracketsToDotted(string $str, string $quotation_marks = ''): string {
        return str_replace(['[', ']'], ['.', ''], $str);
    }
}
if (! function_exists('dottedToBrackets')) {
    // privacies.111.pivot.title => privacies[111][pivot][title]
    /**
     * @param string $str
     * @param string $quotation_marks
     *
     * @return string
     */
    function dottedToBrackets($str, $quotation_marks = '') {
        $str = collect(explode('.', $str))->map(
            function ($v, $k) {
                return 0 === $k ? $v : '['.$v.']';
            }
        )->implode('');

        return $str;
    }
}

if (! function_exists('array_merge_recursive_distinct')) {
    /**
     * @return array
     */
    function array_merge_recursive_distinct(array &$array1, array &$array2) {
        $merged = $array1;

        foreach ($array2 as $key => &$value) {
            if (is_array($value) && isset($merged[$key]) && is_array($merged[$key])) {
                $merged[$key] = array_merge_recursive_distinct($merged[$key], $value);
            } else {
                $merged[$key] = $value;
            }
        }

        return $merged;
    }
}

/*
|--------------------------------------------------------------------------
| Laravel 5 - URL Query String Helper
|--------------------------------------------------------------------------
|
| A helper function to take a URL string then quickly and easily add query
| string parameters to it, or change existing ones.
|
| url_queries(['order' => 'desc', 'page' => 2],
|             'https://app.dev/users/?sort=username&order=asc');
| // https://app.dev/users/?sort=username&order=desc&page=2
|
https://gist.github.com/ImLiam/49c420ddb2db881afd59d77635d039f8
*/
if (! function_exists('url_queries')) {
    /**
     * Modifies the query strings in a given (or the current) URL.
     *
     * @param array       $queries Indexed array of query parameters
     * @param string|null $url     URL to use parse. If none is supplied, the current URL of the page load will be used
     *
     * @return string The updated query string
     */
    function url_queries(array $queries, string $url = null) {
        // If a URL isn't supplied, use the current one
        if (! $url) {
            $url = \Request::fullUrl();
        }
        // Split the URL down into an array with all the parts separated out
        $url_parsed = parse_url($url);
        if (false === $url_parsed) {
            throw new \Exception('error parsing url ['.$url.']');
        }
        // Turn the query string into an array
        $url_params = [];
        // Cannot access offset 'query' on array(?'scheme' => string, ?'host' => string, ?'port' => int, ?'user' => string, ?'pass' => string, ?'path' => string, ?'query' => string, ?'fragment' => string)|false.
        if (isset($url_parsed['query'])) {
            // if (in_array('query', array_keys($url_parsed))) {
            parse_str($url_parsed['query'], $url_params);
        }
        // Merge the existing URL's query parameters with our new ones
        $url_params = array_merge($url_params, $queries);
        // Build a new query string from our updated array
        $string_query = http_build_query($url_params);
        // Add the new query string back into our URL
        $url_parsed['query'] = $string_query;
        // Build the array back into a complete URL string
        $url = build_url($url_parsed);

        return $url;
    }
}
if (! function_exists('build_url')) {
    /**
     * Rebuilds the URL parameters into a string from the native parse_url() function.
     *
     * @param array $parts The parts of a URL
     *
     * @return string The constructed URL
     */
    function build_url(array $parts) {
        return (isset($parts['scheme']) ? "{$parts['scheme']}:" : '').
            ((isset($parts['user']) || isset($parts['host'])) ? '//' : '').
            (isset($parts['user']) ? "{$parts['user']}" : '').
            (isset($parts['pass']) ? ":{$parts['pass']}" : '').
            (isset($parts['user']) ? '@' : '').
            (isset($parts['host']) ? "{$parts['host']}" : '').
            (isset($parts['port']) ? ":{$parts['port']}" : '').
            (isset($parts['path']) ? "{$parts['path']}" : '').
            (isset($parts['query']) ? "?{$parts['query']}" : '').
            (isset($parts['fragment']) ? "#{$parts['fragment']}" : '');
    }
}

if (! function_exists('getRelationships')) {
    /**
     * @throws ReflectionException
     *
     * @return array
     */
    function getRelationships(Model $model) {
        // working
        $methods = get_class_methods($model);
        $data = [];
        if (! is_array($methods)) {
            return $data;
        }
        foreach ($methods as $method) {
            $reflection = new \ReflectionMethod($model, $method);
            $args = $reflection->getParameters();
            if (0 === count($args) && $reflection->class === get_class($model)) {
                try {
                    $return = $reflection->invoke($model);
                    $check = ($return instanceof \Illuminate\Database\Eloquent\Relations\Relation);
                    if ($check) {
                        $related_model = (new \ReflectionClass($return->getRelated()))->getName();
                        $msg = [
                            'name' => $reflection->name,
                            'type' => class_basename($return),
                            // 'check'=>$check,
                            // $msg['type']=(new \ReflectionClass($return))->getShortName();
                            'model' => $related_model,
                        ];
                        $data[] = $msg;
                    }
                } catch (ErrorException $e) {
                }
            }
        }

        return $data;
    }
}

/*
    public function getRelationshipsV2($model){
        $relationships = [];

        foreach((new \ReflectionClass($model))->getMethods(\ReflectionMethod::IS_PUBLIC) as $method){
            if ($method->class != get_class($model) ||
                !empty($method->getParameters()) ||
                $method->getName() == __FUNCTION__) {
                continue;
            }

            try {
                $return = $method->invoke($model);

                if ($return instanceof \Illuminate\Database\Eloquent\Relations\Relation) {
                    $relationships[$method->getName()] = [
                        'name' => $method->getName(),
                        'type' => (new \ReflectionClass($return))->getShortName(),
                        'model' => (new \ReflectionClass($return->getRelated()))->getName()
                    ];
                }
            } catch(ErrorException $e) {}
        }

        return $relationships;
    }
    */

/*
 * https://chasingcode.dev/blog/laravel-global-url-helpers/
 * URL before:
 * https://example.com/orders/123?order=ABC009&status=shipped
 *
 * 1. removeQueryParams(['status'])
 * 2. removeQueryParams(['status', 'order'])
 *
 * URL after:
 * 1. https://example.com/orders/123?order=ABC009
 * 2. https://example.com/orders/123
 */

if (! function_exists('removeQueryParams')) {
    /**
     * @return string
     */
    function removeQueryParams(array $params = []) {
        $url = url()->current(); // get the base URL - everything to the left of the "?"
        $query = request()->query(); // get the query parameters (what follows the "?")

        foreach ($params as $param) {
            unset($query[$param]); // loop through the array of parameters we wish to remove and unset the parameter from the query array
        }
        // 924    Parameter #1 $querydata of function http_build_query expects array|object, array|string given.
        return $query ? $url.'?'.http_build_query($query) : $url; // rebuild the URL with the remaining parameters, don't append the "?" if there aren't any query parameters left
    }
}

/*
 * https://chasingcode.dev/blog/laravel-global-url-helpers/
 * URL before:
 * https://example.com/orders/123?order=ABC009
 *
 * 1. addQueryParams(['status' => 'shipped'])
 * 2. addQueryParams(['status' => 'shipped', 'coupon' => 'CCC2019'])
 *
 * URL after:
 * 1. https://example.com/orders/123?order=ABC009&status=shipped
 * 2. https://example.com/orders/123?order=ABC009&status=shipped&coupon=CCC2019
 */
if (! function_exists('addQueryParams')) {
    /**
     * @return string
     */
    function addQueryParams(array $params = []) {
        $query = array_merge(
            (array) request()->query(),
            $params
        ); // merge the existing query parameters with the ones we want to add

        return url()->current().'?'.http_build_query($query); // rebuild the URL with the new parameters array
    }
}

if (! function_exists('isJson')) {
    /*
    function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
    */
    /*
    function isJson($string) {
    return ((is_string($string) &&
            (is_object(json_decode($string)) ||
            is_array(json_decode($string))))) ? true : false;
    }
    */
    /**
     * @param string $string
     *
     * @return bool
     */
    function isJson($string) {
        return is_string($string) && is_array(json_decode($string, true)) ? true : false;
    }
}

if (! function_exists('getExcerpt')) {
    function getExcerpt(string $str, int $length = 225): string {
        $cleaned = strip_tags(
            (string) preg_replace(['/<pre>[\w\W]*?<\/pre>/', '/<h\d>[\w\W]*?<\/h\d>/'], '', $str),
            '<code>'
        );
        $truncated = substr($cleaned, 0, $length);

        if (substr_count($truncated, '<code>') > substr_count($truncated, '</code>')) {
            $truncated .= '</code>';
        }

        return strlen($cleaned) > $length
            ? preg_replace('/\s+?(\S+)?$/', '', $truncated).'...'
            : $cleaned;
    }
}

if (! function_exists('getRouteParameters')) {
    function getRouteParameters(): array {
        $params = optional(request()->route())->parameters();
        if (null === $params) {
            $params = [];
        }

        return $params;
    }
}

if (! function_exists('getModTradFilepath')) {
    function getModTradFilepath(string $file_path): string {
        $file_path = Str::replace('\\', '/', $file_path);

        $ns = Str::of($file_path)->after('/Modules/')->before('/')->lower();
        $info = pathinfo($file_path);
        $group = Str::snake($info['filename']);
        $mod_trad = $ns.'::'.$group;

        return $mod_trad;
    }
}

/*

    function is_iterable($var)
{
    return $var !== null
        && (is_array($var)
            || $var instanceof Traversable
            || $var instanceof Iterator
            || $var instanceof IteratorAggregate
            );
}
*/

if (! function_exists('is_active')) {
    /**
     * Determines if the given routes are active.
     */
    function is_active(array $routes): bool {
        return (bool) call_user_func_array([app('router'), 'is'], (array) $routes);
    }
}

if (! function_exists('md_to_html')) {
    /**
     * Convert Markdown to HTML.
     */
    function md_to_html(?string $markdown): ?string {
        return $markdown;
        // return app(App\Markdown\Converter::class)->toHtml($markdown);
    }
}

if (! function_exists('replace_links')) {
    /**
     * Convert Standalone Urls to HTML.
     */
    function replace_links(string $markdown): string {
        /*
        return (new LinkFinder([
            'attrs' => ['target' => '_blank', 'rel' => 'nofollow'],
        ]))->processHtml($markdown);
        */
        return $markdown;
    }
}

if (! function_exists('debugStack')) {
    /**
     * Undocumented function.
     *
     * @return void
     */
    function debugStack() {
        if (! extension_loaded('xdebug')) {
            throw new \RuntimeException('XDebug must be installed to use this function');
        }

        xdebug_set_filter(
            XDEBUG_FILTER_TRACING,
            XDEBUG_PATH_EXCLUDE,
            [LARAVEL_DIR.'/vendor/']
        );

        xdebug_print_function_stack();
    }
}

if (! function_exists('secondsToHms')) {
    function secondsToHms(float $seconds): string {
        $hours = floor($seconds / 3600);
        $seconds -= $hours * 3600;
        $minutes = floor(($seconds / 60));
        $seconds -= $minutes * 60;
        $str = '';
        if ($hours > 0) {
            $str .= ($hours < 9 ? '0'.$hours : $hours).':';
        }
        $str .= ($minutes < 9 ? '0'.$minutes : $minutes).':'.round($seconds, 3);

        return $str;
    }
}

if (! function_exists('rowsToSql')) {
    /**
     * Undocumented function.
     *
     * @param \Illuminate\Database\Eloquent\Relations\HasOne $rows
     */
    function rowsToSql($rows): string {
        // $sql = str_replace('?', $rows->getBindings(), $rows->toSql());
        $sql = Str::replaceArray('?', $rows->getBindings(), $rows->toSql());

        return $sql;
    }
}
