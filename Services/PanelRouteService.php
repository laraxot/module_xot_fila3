<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Modules\Xot\Contracts\PanelContract;

/**
 * Class PanelRouteService.
 */
class PanelRouteService {
    public PanelContract $panel;

    /*
    public function __construct(&$panel) {
        $this->panel = $panel;
    }
    */

    /**
     * setPanel.
     *
     * @return $this
     */
    public function setPanel(PanelContract &$panel) {
        $this->panel = $panel;

        return $this;
    }

    /**
     * @return array|bool|mixed
     */
    public static function inAdmin(array $params = []) {
        if (isset($params['in_admin'])) {
            return $params['in_admin'];
        }
        //dddx(ThemeService::__getStatic('in_admin'));
        if (null !== config()->get('in_admin')) {
            return config()->get('in_admin');
        }
        if ('admin' == \Request::segment(1)) {
            return true;
        }
        $segments = (\Request::segments());
        if (count($segments) > 0 && 'livewire' == $segments[0]) {
            if (true == session()->get('in_admin')) {
                return true;
            }
        }

        return false;
        //dddx(session('in_admin'));
        /*
        $segments = request()->segments();
        dddx($_SERVER);

        return 'admin' == 'aa';
        */
        //return in_admin();
    }

    public function addCacheQueryString(string $route): string {
        $path = '/'.request()->path();
        $cache_key = $path.'_query';
        Cache::forever($cache_key, request()->query());
        //echo '[cache_key['.$cache_key.']['.$route.']]';

        //--- aggiungo le query string all'url corrente
        //$queries = collect(request()->query())->except(['_act', 'item0', 'item1'])->all();
        $cache_key = Str::before($route, '?').'_query';

        $queries = Cache::get($cache_key);
        if (! is_array($queries)) {
            $queries = [];
        }

        $url = url_queries($queries, $route);

        if (Str::endsWith($url, '?')) {
            $url = Str::before($url, '?');
        }
        $url = str_replace(url('/'), '/', $url);

        return $url;
    }

    public function urlPanel(array $params = []): string {
        $panel = $this->panel;
        $act = 'show'; //default
        extract($params);
        //panel lo potrei passare da parametro
        $breads = $panel->getBreads();

        $n = 0;
        $parz = ['n' => $n + $breads->count() - 1, 'act' => $act];

        if (isset($in_admin)) {
            $parz['in_admin'] = $in_admin;
        }
        if (isset($panel->in_admin)) {
            $parz['in_admin'] = $panel->in_admin;
        }

        $route_name = self::getRoutenameN($parz);

        $route_params = $panel->getRouteParams();
        $i = 0;

        foreach ($breads as $bread) {
            $route_params['container'.($n + $i)] = $bread->getName();
            $route_params['item'.($n + $i)] = $bread->guid();
            ++$i;
        }

        if (inAdmin($params) && ! isset($route_params['module'])) {
            $container0 = $route_params['container0'];
            $model = xotModel($container0);
            $module_name = (string) getModuleNameFromModel($model);
            $route_params['module'] = strtolower($module_name);
        }

        try {
            $route = route($route_name, $route_params, false);
        } catch (\Exception $e) {
            if (request()->input('debug', false)) {
                dddx(
                    ['e' => $e->getMessage(),
                        'params' => $params,
                        'route_name' => $route_name,
                        'route_params' => $route_params,
                        'last row' => $panel->getRow(),
                        'panel post type' => $panel->postType(),
                        'panel guid' => $panel->guid(),
                        'last route key ' => $panel->getRow()->getRouteKey(),
                        'last route key name' => $panel->getRow()->getRouteKeyName(),
                        'in_admin' => config()->get('in_admin'),
                        'in_admin_session' => session()->get('in_admin'),
                        //'routes' => \Route::getRoutes(),
                    ]
                );
            }

            return '#['.__LINE__.']['.__FILE__.']['.$e->getMessage().']';
        }

        return $this->addCacheQueryString($route);
        /*
        if(!in_array($act,['update','create','edit','show'])){
            dddx(
                [
                    'act'=>$act,
                    'route'=>$route,
                    'params' => $params,
                    'route_name' => $route_name,
                    'route_params' => $route_params,
                    //'routes' => \Route::getRoutes(),
                ]);
        }
        */

        /*
        //--- aggiungo le query string all'url corrente
        $queries = collect(request()->query())->except(['_act', 'item0', 'item1'])->all();

        $url = url_queries($queries, $route);

        if (Str::endsWith($url, '?')) {
            $url = Str::before($url, '?');
        }
        $url=str_replace(url('/'),'/',$url);
        */
    }

    //se n=0 => 'container0'
    // se n=1 => 'container0.container1'

    /**
     * @param array $params
     *
     * @return string
     */
    public static function getRoutenameN($params) {
        //default vars
        $n = 0;
        $act = 'show';
        extract($params);
        $tmp = [];
        //dddx(inAdmin());
        if (inAdmin($params)) {
            $tmp[] = 'admin';
        }
        for ($i = 0; $i <= $n; ++$i) {
            $tmp[] = 'container'.$i;
        }
        $tmp[] = $act;
        $routename = implode('.', $tmp);

        return $routename;
    }

    /**
     * @param array $params
     *
     * @return string|string[]|void
     */
    public function urlRelatedPanel($params) {
        $panel = $this->panel;
        $act = 'show';
        extract($params);

        if (! isset($related_name)) {
            dddx(['err' => 'related_name is missing']);

            return;
        }

        $panel = $this->panel;

        $act = 'show'; //default
        extract($params);
        //panel lo potrei passare da parametro
        $breads = $panel->getBreads();

        //dddx($breads);

        $n = 0;
        $parz = ['n' => $n + $breads->count(), 'act' => $act];

        if (isset($in_admin)) {
            $parz['in_admin'] = $in_admin;
        }
        if (isset($panel->in_admin)) {
            $parz['in_admin'] = $panel->in_admin;
        }

        $route_name = self::getRoutenameN($parz);

        //dddx($route_name);

        $route_params = $panel->getRouteParams();
        $i = 0;
        foreach ($breads as $bread) {
            $route_params['container'.($n + $i)] = $bread->getName();
            $route_params['item'.($n + $i)] = $bread->guid();
            ++$i;
        }

        $route_params['container'.($n + $i)] = $related_name;

        if (inAdmin($params) && ! isset($route_params['module'])) {
            $container0 = $route_params['container0'];
            $model = xotModel($container0);
            $module_name = (string) getModuleNameFromModel($model);
            $route_params['module'] = strtolower($module_name);
        }

        //$route_params['page'] = 1;
        $route_params['_act'] = '';
        unset($route_params['_act']);

        try {
            $route = route($route_name, $route_params, false);
        } catch (\Exception $e) {
            if (request()->input('debug', false)) {
                dddx(
                    ['e' => $e->getMessage(),
                        'params' => $params,
                        'route_name' => $route_name,
                        'route_params' => $route_params,
                        'last row' => $panel->getRow(),
                        'panel post type' => $panel->postType(),
                        'panel guid' => $panel->guid(),
                        'last route key ' => $panel->getRow()->getRouteKey(),
                        'last route key name' => $panel->getRow()->getRouteKeyName(),
                        'in_admin' => config()->get('in_admin'),
                        'in_admin_session' => session()->get('in_admin'),
                        //'routes' => \Route::getRoutes(),
                    ]
                );
            }

            return '#['.__LINE__.']['.__FILE__.']['.$e->getMessage().']';
        }
        /*
        if(in_array($act,['index_edit'])){
            dddx(
                [
                    'act'=>$act,
                    'route'=>$route,
                    'route1'=>Str::before($route,'?'),
                    'params' => $params,
                    'route_name' => $route_name,
                    'route_params' => $route_params,
                    'request_query' => request()->query(),
                    'request_url' => request()->url(),
                    'request_path' => '/'.request()->path(),
                    //'ff'=> \Route::current()->parameters(),
                    //'routes' => \Route::getRoutes(),
                ]);
        }
        */
        return $this->addCacheQueryString($route);
        /*
        $path='/'.request()->path();
        $cache_key=$path.'_query';
        Cache::forever($cache_key, request()->query());


        //--- aggiungo le query string all'url corrente
        //$queries = collect(request()->query())->except(['_act', 'item0', 'item1'])->all();
        $queries=Cache::get($route.'_query');
        if(!is_array($queries)){
            $queries=[];
        }

        $url = url_queries($queries, $route);

        if (Str::endsWith($url, '?')) {
            $url = Str::before($url, '?');
        }
        $url=str_replace(url('/'),'/',$url);

        return $url;
        */
    }

    /**
     * @return string
     */
    public static function urlLang(array $params = []) {
        extract($params);

        return '?';
        /*
        return '?'.$lang; //da fixare dopo
        //$row=$this->row;
        //$row->lang=$lang;
        //return '/wip'.$this->url();
        $route_name = \Route::currentRouteName();
        $route_params = \Route::current()->parameters();
        $route_params['lang'] = $lang;
        [$containers, $items] = params2ContainerItem($route_params);
        $n_items = count($items);
        //ddd($n_items);//1
        //ddd($route_name); container0.show
        for ($i = 0; $i < $n_items; ++$i) {
            $v = $items[$i];
            if (method_exists($v, 'postLang')) {
                $tmp = $v->postLang($lang)->first();
                if (is_object($tmp)) {
                    $guid = $tmp->guid;
                } else {
                    $guid = '#';
                    //dddx(app()->getLocale());
                    $v_post = $v->post;
                    if (null == $v_post) {
                        break;
                    }
                    $new_post = $v_post->replicate();
                    $fields = ['title', 'subtitle', 'txt', 'meta_description', 'meta_keywords'];
                    foreach ($fields as $field) {
                        $trans = ImportService::trans(['q' => $new_post->$field, 'from' => app()->getLocale(), 'to' => $lang]);

                        //dddx([
                        //    'from'=>app()->getLocale(),
                        //    'to'=>$lang,
                        //    'trans'=>$trans,

                        //]);

                        $new_post->$field = $trans;
                    }
                    $new_post->lang = $lang;
                    $new_post->save();
                    $guid = $new_post->guid;
                }
            } else {
                $route_key_name = $v->getRouteKeyName();
                $guid = $v->$route_key_name;
            }

            $route_params['item'.$i] = $guid;
            //ddd($route_params['item'.$i]->guidLang);
        }
        //dddx($route_params);
        //return '/wip['.__LINE__.']['.__FILE__.']';
        try {
            return route($route_name, $route_params);
        } catch (\Exception $e) {
            return url($lang);
        }
        */
    }
}
