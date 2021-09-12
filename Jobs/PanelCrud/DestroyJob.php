<?php

declare(strict_types=1);

namespace Modules\Xot\Jobs\PanelCrud;

use Modules\Xot\Contracts\PanelContract;

//----------- Requests ----------
//------------ services ----------

/**
 * Class DestroyJob.
 */
class DestroyJob extends XotBaseJob {
    public function handle(): PanelContract {
        //per cancellare tabelle collegare esempio se cancello "profilo" voglio cancellare anche "utente"
        if (method_exists($this->panel, 'destroyCallback')) {
            $this->panel->destroyCallback();
        }
        //dd(get_class_methods($this->panel->getRow()));
        //dd([__LINE__, __FILE__, $this->panel->getRow()->getRelations()]);
        $res = $this->panel->getRow()->delete();
        if ($res) {
            \Session::flash('status', 'eliminato');
        } else {
            \Session::flash('status', 'NON eliminato');
        }

        return $this->panel;
    }
}
