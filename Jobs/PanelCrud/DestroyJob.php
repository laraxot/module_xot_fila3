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
<<<<<<< HEAD
        //per cancellare tabelle collegare esempio se cancello "profilo" voglio cancellare anche "utente"
        if (method_exists($this->panel, 'destroyCallback')) {
            $this->panel->destroyCallback();
        }
        //dd(get_class_methods($this->panel->row));
        //dd([__LINE__, __FILE__, $this->panel->row->getRelations()]);
        $res = $this->panel->row->delete();
        if ($res) {
            \Session::flash('status', 'eliminato');
        } else {
            \Session::flash('status', 'NON eliminato');
        }

        return $this->panel;
    }
}
=======
        $this->panel->row->delete();
        \Session::flash('status', 'eliminato');

        return $this->panel;
    }
}
>>>>>>> 3c97c308c85924a62f31c89c71edfe23450749f0
