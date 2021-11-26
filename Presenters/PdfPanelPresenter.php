<?php

declare(strict_types=1);

namespace Modules\Xot\Presenters;

use Illuminate\Support\Collection;
use Modules\Theme\Services\ThemeService;
use Modules\Xot\Contracts\PanelContract;
use Modules\Xot\Contracts\PanelPresenterContract;
use Modules\Xot\Services\HtmlService;

/**
 * Class JsonPanelPresenter.
 */
class PdfPanelPresenter implements PanelPresenterContract {
    protected PanelContract $panel;

    public array $view_params = [];

    public function setPanel(PanelContract &$panel): self {
        $this->panel = $panel;

        return $this;
    }

    public function setViewParams(array $view_params): self {
        $this->view_params = $view_params;

        return $this;
    }

    /**
     * @return mixed|void
     */
    public function index(?Collection $items) {
    }

    /**
     * @return mixed
     */
    public function out(?array $params = null) {
        if (! isset($params['view_params'])) {
            $params['view_params'] = [];
        }
        $view = ThemeService::getView(); //progressioni::admin.schede.show
        $view .= '.pdf';
        $view = str_replace('.store.', '.show.', $view);
        extract($params);
        $row = $this->panel->getRow();
        $rows = $this->panel->rows();
        if (null == $row->getKey()) { //utile per le cose a containers
            $row = $this->panel->rows()->first();
        }

        $view_params = [
            'view' => $view,
            'row' => $row,
            'rows' => $rows,
        ];

        $view_params = array_merge($view_params, $this->view_params);

        $html = view()->make($view, $view_params);
        $html = $html->render();
        //dddx($this->rows->get());
        if (request()->input('debug')) {
            return $html;
        }
        $params['html'] = (string) $html;

        return HtmlService::toPdf($params);
    }
}