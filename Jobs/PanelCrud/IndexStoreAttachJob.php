<?php

declare(strict_types=1);

namespace Modules\Xot\Jobs\PanelCrud;

use Illuminate\Support\Str;
use Modules\Xot\Contracts\PanelContract;

<<<<<<< HEAD
// ----------- Requests ----------
// ------------ services ----------
=======
//----------- Requests ----------
//------------ services ----------
>>>>>>> 9472ad4 (first)

/**
 * Class IndexStoreAttachJob.
 */
class IndexStoreAttachJob extends XotBaseJob {
    public function handle(): PanelContract {
        $name = Str::plural($this->panel->postType());
        $rows = $this->panel->getRows();
        $to = $this->data[$name]['to'];
<<<<<<< HEAD
        if (! \is_array($to)) {
            $to = [];
        }
        if (! method_exists($rows, 'detach')) {
            throw new \Exception('in ['.\get_class($rows).'] method [detach] not exists ['.__LINE__.']['.__FILE__.']');
        }
        if (! method_exists($rows, 'attach')) {
            throw new \Exception('in ['.\get_class($rows).'] method [attach] not exists ['.__LINE__.']['.__FILE__.']');
        }
        if (! method_exists($rows, 'getRelated')) {
            throw new \Exception('in ['.\get_class($rows).'] method [getRelated] not exists ['.__LINE__.']['.__FILE__.']');
=======
        if (! is_array($to)) {
            $to = [];
        }
        if (! method_exists($rows, 'detach')) {
            throw new \Exception('in ['.get_class($rows).'] method [detach] not exists ['.__LINE__.']['.__FILE__.']');
        }
        if (! method_exists($rows, 'attach')) {
            throw new \Exception('in ['.get_class($rows).'] method [attach] not exists ['.__LINE__.']['.__FILE__.']');
        }
        if (! method_exists($rows, 'getRelated')) {
            throw new \Exception('in ['.get_class($rows).'] method [getRelated] not exists ['.__LINE__.']['.__FILE__.']');
>>>>>>> 9472ad4 (first)
        }

        $related = $rows->getRelated();
        $items_key = $related->getKeyName();

<<<<<<< HEAD
        // Method Illuminate\Support\Collection<int,mixed>::get() invoked with 0 parameters, 1-2 required.
=======
        //Method Illuminate\Support\Collection<int,mixed>::get() invoked with 0 parameters, 1-2 required.
>>>>>>> 9472ad4 (first)
        $items_0 = $rows->get()->pluck($items_key);

        $items_1 = collect($to);
        $items_add = $items_1->diff($items_0);
        $items_sub = $items_0->diff($items_1);

        $rows->detach($items_sub->all());
        $rows->attach($items_add->all());

<<<<<<< HEAD
        $status = 'collegati ['.implode(', ', $items_add->all()).'] scollegati ['.implode(', ', $items_sub->all()).']';
=======
        $status = 'collegati ['.\implode(', ', $items_add->all()).'] scollegati ['.\implode(', ', $items_sub->all()).']';
>>>>>>> 9472ad4 (first)
        \Session::flash('status', $status);

        return $this->panel;
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 9472ad4 (first)
