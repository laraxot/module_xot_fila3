<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Illuminate\Support\Collection;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;
use Modules\Xot\Contracts\PanelContract;
use Modules\Xot\Models\Panels\Actions\XotBasePanelAction;


/**
 * Undocumented class
 *

 */
class TreeService {

    /**
     * @param \Illuminate\Database\Eloquent\Collection|Model[] $coll
     */
    public static function mapItems(Collection $coll, ?PanelContract $parent, /* bool $in_admin, */ array $route_params): Collection {
=======
use Modules\Xot\Contracts\PanelContract;

class TreeService
{
    public static function mapItems(Collection $coll, ?PanelContract $parent = null, /*bool $in_admin,*/ array $route_params): Collection
    {
>>>>>>> 9472ad4 (first)
        return $coll->map(
            function ($item) use ($parent, $route_params) {
                $panel = PanelService::make()->get($item)->setParent($parent);
                $panel->setInAdmin(true);
                $panel->setRouteParams($route_params);
<<<<<<< HEAD
                // dddx($panel->getXotModelName());
=======
                //dddx($panel->getXotModelName());
>>>>>>> 9472ad4 (first)

                if (method_exists($panel, 'getActs')) {
                    $acts = $panel->getActs();
                } else {
                    $acts = [
                        [
                            'title' => 'modifica '.$panel->getXotModelName(),
                            'url' => $panel->url('edit'),
                        ],
                        [
                            'title' => 'crea '.$panel->getXotModelName(),
                            'url' => $panel->url('create'),
                        ],
                    ];
                }
<<<<<<< HEAD
                // *
                /**
                 * @var  Collection<XotBasePanelAction>
                 */
                $itemActions=$panel->itemActions();
                foreach ($itemActions as $action) {
                    // $action->btnHtml(['title' => true, 'class' => 'dropdown-item','in_admin'=>$in_admin])
=======
                //*
                foreach ($panel->itemActions() as $action) {
                    //$action->btnHtml(['title' => true, 'class' => 'dropdown-item','in_admin'=>$in_admin])
>>>>>>> 9472ad4 (first)
                    $act = [
                        'title' => $action->getTitle(),
                        'url' => $action->getUrl(),
                    ];
                    $acts[] = $act;
                }
<<<<<<< HEAD
                // */
                // dddx($panel);
                if (! method_exists($panel, 'subsIconMenuAdmin')) {
                    throw new \Exception('in ['.\get_class($panel).'] not exist [subsIconMenuAdmin] method');
=======
                //*/
                //dddx($panel);
                if (! method_exists($panel, 'subsIconMenuAdmin')) {
                    throw new \Exception('in ['.get_class($panel).'] not exist [subsIconMenuAdmin] method');
>>>>>>> 9472ad4 (first)
                }

                return [
                    'id' => $panel->id(),
                    'title' => $panel->title(),
                    'acts' => $acts,
                    'open' => false,
<<<<<<< HEAD
                    'subsIconMenuAdmin' => $panel->subsIconMenuAdmin(), // mi dice se ha figli oppure no, per visualizzare (o no) l'icona freccetta delle sottovoci
=======
                    'subsIconMenuAdmin' => $panel->subsIconMenuAdmin(), //mi dice se ha figli oppure no, per visualizzare (o no) l'icona freccetta delle sottovoci
>>>>>>> 9472ad4 (first)
                ];
            }
        );
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 9472ad4 (first)
