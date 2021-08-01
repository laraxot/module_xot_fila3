<?php

declare(strict_types=1);

namespace Modules\Xot\Presenters;

use Illuminate\Support\Collection;
use Modules\Theme\Services\ThemeService;
use Modules\Xot\Contracts\PanelContract;
use Modules\Xot\Contracts\PanelPresenterContract;

/**
 * Class HtmlPanelPresenter.
 */
class HtmlPanelPresenter implements PanelPresenterContract {
    protected PanelContract $panel;

    public function setPanel(PanelContract &$panel): self {
        $this->panel = $panel;

        return $this;
    }

    /**
     * @return mixed|void
     */
    public function index(?Collection $items) {
        /*
        $count = $items->count();
        $last_update = $items
            ->sortByDesc
            ->created_at
            ->first()
            ->created_at
            ->format('d/m/Y');

        $data = [
            'Numero elementi' => $count,
            'Ultimo aggiornamento' => $last_update,
        ];

        return view('workshop::index')->with(compact('items', 'data'));
        */
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function out(?array $params = null) {
        //$route_params = \Route::current()->parameters();

        [$containers, $items] = params2ContainerItem();
        $view = ThemeService::getView(); //vew che dovrebbe essere
        $view_work = ThemeService::getViewWork(); //view effettiva
        $views = ThemeService::getDefaultViewArray(); //views possibili

        $mod_trad = $this->panel->getModuleNameLow().'::'.last($containers);

        //--- per passare la view all'interno dei componenti
        \View::composer(
            '*',
            function ($view_params) use ($view): void {
                \View::share('view', $view);
                $trad = implode('.', array_slice(explode('.', $view), 0, -1));
                \View::share('trad', $trad);
                \View::share('lang', \App::getLocale());
                \View::share('_panel', $this->panel);
                //\View::share('mod_trad', $mod_trad);
            }
        );

        $modal = null;
        if (\Request::ajax()) {
            $modal = 'ajax';
        } elseif ('iframe' == \Request::input('format')) {
            $modal = 'iframe';
        }

        //$rows = $this->panel->rows()->paginate(20);

        //*
        $rows_err = '';

        //dddx([$this->panel, \Request::input()]);

        try {
            $rows = $this->panel->rows()->paginate(20);
        } catch (\Exception $e) {
            $data = [
                'message' => $e->getMessage(),
            ];

            return response()->view('pub_theme::errors.500', $data, 500);
            $rows = null;
            $rows_err = $e;
        } catch (\Error $e) {
            $rows = null;
            $rows_err = $e;
        }
        //*/

        $route_params = [];
        $route_name = '';
        $route_current = \Route::current();
        if (null !== $route_current) {
            $route_params = $route_current->parameters();
            $route_name = $route_current->getName();
        }

        $view_params = [
            'view' => $view,
            'view_work' => $view_work,
            'views' => $views,
            '_panel' => $this->panel,
            '_panel_name' => $this->panel->getName(),
            'row' => $this->panel->row,
            'rows' => $rows,
            'rows_err' => $rows_err,
            'mod_trad' => $mod_trad,
            'trad_mod' => $mod_trad, /// da sostiutire ed uccidere
            'params' => $route_params,
            'routename' => $route_name,
            'modal' => $modal,
            'containers' => $containers,
            'items' => $items,
            'page' => new \Modules\Theme\Services\Objects\PageObject(),
        ];

        if (! view()->exists('pub_theme::layouts.app')) {
            $data = [
                'message' => 'not exists view [pub_theme::layouts.app] 
                    <br/> pub_theme:'.config('xra.pub_theme'),
            ];
            if (view()->exists('pub_theme::errors.500')) {
                return response()->view('pub_theme::errors.500', $data, 500);
            }
            dddx($data);
        }

        //return view($view_work)->with($view_params);
        return view()->make($view_work, $view_params); //->render(); //se metto render , non mi prende piu' i parametri passati con with
    }
}
