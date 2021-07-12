<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Modules\Xot\Services\PanelService;

//use Illuminate\Http\Response;

/**
 * Class PanelMiddleware.
 */
class PanelMiddleware {
    /*
    public function __construct($params) {
        dddx($params);
    }
    */

    /**
     * @return \Illuminate\Http\Response|mixed
     */
    public function handle(Request $request, Closure $next) {
        $parameters = request()->route()->parameters();
        $res=PanelService::getByParams($parameters);

        if(class_basename($res)=='Response'){
            return $res;
        }
        PanelService::setRequestPanel($res);
        return $next($request);
    }

    public function handle_old(Request $request, Closure $next) {
        $parameters = request()->route()->parameters();


        [$containers, $items] = params2ContainerItem($parameters);

        if (0 == count($containers)) {
            PanelService::setRequestPanel(null);

            return $next($request);
        }

        $row = xotModel($containers[0]);
        try {
            $panel = PanelService::get($row);
        } catch (\Exception $e) {
            $data = [
                'message' => $e->getMessage(),
                'lang' => \App::getLocale(),
                'params' => $parameters,
                'testtest' => 'testtest',
                'line' => __LINE__,
                'file' => __FILE__,
            ];

            return response()->view('pub_theme::errors.404', $data, 404);
        }

        $panel->setRows($row);
        $panel->setName($containers[0]);
        if (isset($items[0])) {
            $panel->setItem($items[0]);
        }
        $panel_parent = $panel;

        for ($i = 1; $i < count($containers); ++$i) {
            $row_prev = $panel_parent->row;
            $types=$containers[$i];
            //$types=Str::plural($types);
            $types = Str::camel($types);
            try {
                $rows = $row_prev->{$types}();
            } catch (\Exception $e) {
                $data = [
                    'message' => $e->getMessage(),
                    'lang' => \App::getLocale(),
                    'params' => $parameters,
                    'testtest' => 'testtest',
                    'line' => __LINE__,
                    'file' => __FILE__,
                ];

                return response()->view('pub_theme::errors.404', $data, 404);
            } catch (\Error $e) {
                $data = [
                    'message' => $e->getMessage(),
                    'lang' => \App::getLocale(),
                    'params' => $parameters,
                    'testtest' => 'testtest',
                    'line' => __LINE__,
                    'file' => __FILE__,
                ];

                return response()->view('pub_theme::errors.404', $data, 404);
            }
            $row = $rows->getRelated();

            $panel = PanelService::get($row);
            $panel->setRows($rows);
            $panel->setName($types);
            $panel->setParent($panel_parent);

            if (isset($items[$i])) {
                $panel->setItem($items[$i]);
            }
            $panel_parent = $panel;
        }
        //$request['panel'] = $panel;
        PanelService::setRequestPanel($panel);

        return $next($request);
    }
}
