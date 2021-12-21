<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Modules\Tenant\Services\TenantService;
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

    public function setPanel(PanelContract &$panel): self {
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
        //return inAdmin();
    }

    public function addCacheQueryString(string $route): string {
        $path = '/'.request()->path();
        $cache_key = Str::slug($path.'_query');

        session()->put($cache_key, request()->query(), 60 * 60);
        //echo '[cache_key['.$cache_key.']['.$route.']]';

        //--- aggiungo le query string all'url corrente
        //$queries = collect(request()->query())->except(['_act', 'item0', 'item1'])->all();
        $cache_key = Str::slug(Str::before($route, '?').'_query');

        $queries = session()->get($cache_key);
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

    public function addFilterQueryString(string $url): string {
        $filters = $this->panel->filters();
        $row = $this->panel->row;
        foreach ($filters as $k => $v) {
            $field_value = $row->{$v->field_name};
            if (! isset($v->where_method)) {
                $v->where_method = 'where';
            }
            $where = Str::after($v->where_method, 'where');

            $filters[$k]->field_value = $field_value;
            switch ($where) {
                case 'Year':
                    $value = $field_value->year;
                    break;
                case 'ofYear':
                    $value = \Request::input('year', date('Y'));
                    break;
                case 'Month':
                    $value = $field_value->month;
                    break;
                default:
                    $value = $field_value;
                    break;
            }
            $filters[$k]->value = $value;
        }
        $queries = collect($filters)->pluck('value', 'param_name')->all();
        $node = class_basename($row).'-'.$row->getKey();
        $queries['page'] = Cache::get('page');

        $queries = array_merge(request()->query(), $queries);
        $queries = collect($queries)->except(['_act'])->all();
        $url = (url_queries($queries, $url)).'#'.$node;

        return $url;
    }

    public function url(array $params = []): string {
        $panel = $this->panel;
        $act = 'show'; //default
        extract($params);

        $breads = $panel->getBreads();
        $route_params = [];
        if (inAdmin() && null !== $breads->first()) {
            $route_params['module'] = $breads->first()->getModuleNameLow();
        }
        if (inAdmin() && null == $breads->first()) {
            $route_params['module'] = TenantService::config('xra.main_module', 'xot');
        }

        foreach ($breads as $i => $bread) {
            $route_params['container'.$i] = $bread->getName();
            $route_params['item'.$i] = $bread->guid();
        }

        $route_name = 'containers.'.Str::snake($act);

        if (inAdmin($params)) {
            $route_name = 'admin.'.$route_name;
        }

        //---
        if (Str::startsWith($act, 'index')) {
            [$containers,$items] = \params2ContainerItem($route_params);
            if (count($containers) == count($items) && count($items) > 0) {
                $k = 'item'.(count($items) - 1);
                unset($route_params[$k]);
            }
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

        if ('index' == $act) {
            return $this->addFilterQueryString($route);
        }

        return $this->addCacheQueryString($route);
    }

    public function relatedUrl(array $params): string {
        $panel = $this->panel;
        $act = 'show';
        extract($params);
        if (! isset($related_name)) {
            throw new \Exception('err: related_name is missing');
        }
        //--- solo per velocita'
        $url = $panel->url($params);

        return $url.'/'.$related_name;
    }

    /**
     * @return string
     */
    public static function langUrl(array $params = []) {
        extract($params);

        return '?';
        /*
        return '?'.$lang; //da fixare dopo
        //$row=$this->row;
        //$row->lang=$lang;
        //return '/wip'.$this->url();
        $route_name = \Route::currentRouteName();
        $route_params = optional(\Route::current())->parameters();
        $route_params['lang'] = $lang;
        [$containers, $items] = params2ContainerItem($route_params);
        $n_items = count($items);
        //dddx($n_items);//1
        //dddx($route_name); containers.show
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
            //dddx($route_params['item'.$i]->guidLang);
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
