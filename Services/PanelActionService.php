<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Exception;
use Illuminate\Support\Collection;
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
     * @return Collection|PanelContract[]
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
<<<<<<< HEAD
                    if ($item->$k !== $v) {
=======
                    if ($item->$k != $v) {
>>>>>>> 9472ad4 (first)
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
     * @return Collection&iterable<PanelContract>
     */
    public function containerActions(array $params = []) {
        $params['filters']['onContainer'] = true;

        return $this->getActions($params);
    }

    /**
     * @return Collection&iterable<PanelContract>
     */
    public function itemActions(array $params = []) {
        $params['filters']['onItem'] = true;

        return $this->getActions($params);
    }

    public function getAction(string $name): XotBasePanelAction {
        $action = $this->getActions()
            ->firstWhere('name', $name);
<<<<<<< HEAD
        if (! $action instanceof XotBasePanelAction) {
            throw new Exception('['.__LINE__.']['.__FILE__.']['.gettype($action).']');
        }
=======
>>>>>>> 9472ad4 (first)

        return $action;
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
<<<<<<< HEAD
        if (null === $itemAction) {
            throw new Exception('['.$act.'] is not an ItemAction of ['.class_basename($this->panel).']');
        }
        if (! $itemAction instanceof XotBasePanelAction) {
            throw new Exception('['.__LINE__.']['.__FILE__.']');
        }
=======
        if (null == $itemAction) {
            throw new Exception('['.$act.'] is not an ItemAction of ['.class_basename($this->panel).']');
        }
>>>>>>> 9472ad4 (first)

        return $itemAction;
    }

    public function containerAction(string $act): ?XotBasePanelAction {
        $actions = $this->containerActions();
        $action = $actions->firstWhere('name', $act);
<<<<<<< HEAD
        if (! \is_object($action)) {
=======
        if (! is_object($action)) {
>>>>>>> 9472ad4 (first)
            dddx(
                [
                    'error' => 'nessuna azione con questo nome',
                    'act' => $act,
                    'this' => $this,
                    'Container Actions' => $actions,
                    'panel' => $this->panel,
                    'All Actions' => $this->panel->actions(),
                ]
            );
        }
<<<<<<< HEAD
        // $action->setPanel($this);
        if (! $action instanceof XotBasePanelAction) {
            throw new Exception('['.__LINE__.']['.__FILE__.']');
        }
=======
        //$action->setPanel($this);
>>>>>>> 9472ad4 (first)

        return $action;
    }

    public function urlContainerAction(string $act, array $params = []): string {
<<<<<<< HEAD
        // $containerActions = $this->containerActions();
        // $containerAction = $containerActions->firstWhere('name', $act);
        $containerAction = $this->containerAction($act);
        // 123    Call to an undefined method object::urlContainer().
        if (\is_object($containerAction) /* && $containerAction instanceof XotBasePanelAction */) {
=======
        //$containerActions = $this->containerActions();
        //$containerAction = $containerActions->firstWhere('name', $act);
        $containerAction = $this->containerAction($act);
        //123    Call to an undefined method object::urlContainer().
        if (is_object($containerAction) /* && $containerAction instanceof XotBasePanelAction */) {
>>>>>>> 9472ad4 (first)
            return $containerAction->urlContainer();
        }

        return '#';
    }

    public function urlItemAction(string $act, array $params = []): string {
        $itemAction = $this->itemAction($act);
<<<<<<< HEAD
        if (\is_object($itemAction)) {
=======
        if (is_object($itemAction)) {
>>>>>>> 9472ad4 (first)
            return $itemAction->urlItem();
        }

        return '#';
    }

    /**
     * @return mixed
     */
    public function btnItemAction(string $act, array $params = []) {
        $itemAction = $this->itemAction($act);
<<<<<<< HEAD
        if (\is_object($itemAction)) {
            // return $itemAction->btn(['row' => $this->panel->getRow(), 'panel' => $this->panel]);
            return $itemAction->btn($params);
        }
    }
}
=======
        if (is_object($itemAction)) {
            //return $itemAction->btn(['row' => $this->panel->getRow(), 'panel' => $this->panel]);
            return $itemAction->btn($params);
        }
    }
}
>>>>>>> 9472ad4 (first)
