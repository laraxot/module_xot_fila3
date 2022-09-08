<?php

declare(strict_types=1);

namespace Modules\Xot\Jobs\PanelCrud;

use Modules\Xot\Contracts\PanelContract;

<<<<<<< HEAD
// ----------- Requests ----------
// ------------ services ----------
=======
//----------- Requests ----------
//------------ services ----------
>>>>>>> 9472ad4 (first)

/**
 * Class DestroyJob.
 */
<<<<<<< HEAD
class DestroyJob extends XotBaseJob {
    public function handle(): PanelContract {
        $row = $this->panel->getRow();
        // per cancellare tabelle collegate esempio se cancello "profilo" voglio cancellare anche "utente"
=======
class DestroyJob extends XotBaseJob
{
    public function handle(): PanelContract
    {
        $row = $this->panel->getRow();
        //per cancellare tabelle collegate esempio se cancello "profilo" voglio cancellare anche "utente"
>>>>>>> 9472ad4 (first)
        if (method_exists($this->panel, 'destroyCallback')) {
            $this->panel->destroyCallback(['row' => $row]);
        }

        $res = $row->delete();
        if ($res) {
            \Session::flash('status', 'eliminato');
        } else {
            \Session::flash('status', 'NON eliminato');
        }

        return $this->panel;
    }
}
