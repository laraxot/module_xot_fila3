<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Modules\Xot\Contracts\PanelContract;
use Modules\Xot\Models\Panels\Actions\XotBasePanelAction;

/**
 * Class PanelActionService.
 */
class PanelActionService {
    protected PanelContract $panel;

    /**
     * PanelActionService constructor.
     */
    public function __construct(PanelContract &$panel) {
        $this->panel = $panel;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getActions(array $params = []) {
        $panel = $this->panel;

        extract($params);
        if (! isset($filters)) {
            $filters = [];
        }
        $actions = collect($panel->actions())->filter(
            function ($item) use ($filters) {
                $item->getName();
                $res = true;
                foreach ($filters as $k => $v) {
                    if (! isset($item->$k)) {
                        $item->$k = false;
                    }
                    if ($item->$k != $v) {
                        return false;
                    }
                }

                return $res;
            }
        )->map(
            function ($item) use ($panel) {
                $item->setPanel($panel);

                return $item;
            }
        );

        return $actions;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function containerActions(array $params = []) {
        $params['filters']['onContainer'] = true;

        return $this->getActions($params);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function itemActions(array $params = []) {
        $params['filters']['onItem'] = true;

        return $this->getActions($params);
    }

    public function itemAction(string $act): ?XotBasePanelAction {
        $itemActions = $this->itemActions();
        $itemAction = $itemActions->firstWhere('name', $act);
        /*
        if (! is_object($itemAction)) {
            dddx([
                'error' => 'nessuna azione con questo nome',
                'act' => $act,
                'this' => $this,
                'itemActions' => $itemActions,
            ]);
        }
        //$itemAction->setPanel($this); //incerto dovrebbe farlo getActions
        */

        return $itemAction;
    }

    /**
     * @return mixed
     */
    public function containerAction(string $act) {
        $actions = $this->containerActions();
        $action = $actions->firstWhere('name', $act);
        if (! is_object($action)) {
            dddx([
                'error' => 'nessuna azione con questo nome',
                'act' => $act,
                'this' => $this,
                'Container Actions' => $actions,
                'panel' => $this->panel,
                'All Actions' => $this->panel->actions(),
            ]);
        }
        //$action->setPanel($this);

        return $action;
    }

    /**
     * @return mixed
     */
    public function urlContainerAction(string $act, array $params = []) {
        $containerActions = $this->containerActions();
        $containerAction = $containerActions->firstWhere('name', $act);
        if (is_object($containerAction)) {
            return $containerAction->urlContainer(['rows' => $this->panel->getRows(), 'panel' => $this->panel]);
        }
    }

    /**
     * @return mixed
     */
    public function urlItemAction(string $act, array $params = []) {
        $itemAction = $this->itemAction($act);
        if (is_object($itemAction)) {
            //return $itemAction->urlItem(['row' => $this->panel->getRow(), 'panel' => $this->panel]);
            return $itemAction->urlItem($act);
        }
    }

    /**
     * @return mixed
     */
    public function btnItemAction(string $act, array $params = []) {
        $itemAction = $this->itemAction($act);
        if (is_object($itemAction)) {
            //return $itemAction->btn(['row' => $this->panel->getRow(), 'panel' => $this->panel]);
            return $itemAction->btn($params);
        }
    }
}
