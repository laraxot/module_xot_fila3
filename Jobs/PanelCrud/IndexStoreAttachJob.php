<?php

declare(strict_types=1);

namespace Modules\Xot\Jobs\PanelCrud;

use Illuminate\Support\Str;
use Modules\Xot\Contracts\PanelContract;

// ----------- Requests ----------
// ------------ services ----------

/**
 * Class IndexStoreAttachJob.
 */
class IndexStoreAttachJob extends XotBaseJob
{
    public function handle(): PanelContract
    {
        $name = Str::plural($this->panel->postType());
        $rows = $this->panel->getRows();
        $to = $this->data[$name]['to'];
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
        }

        $related = $rows->getRelated();
        $items_key = $related->getKeyName();

        // Method Illuminate\Support\Collection<int,mixed>::get() invoked with 0 parameters, 1-2 required.
        $items_0 = $rows->get()->pluck($items_key);

        $items_1 = collect($to);
        $items_add = $items_1->diff($items_0);
        $items_sub = $items_0->diff($items_1);

        $rows->detach($items_sub->all());
        $rows->attach($items_add->all());

        $status = 'collegati ['.implode(', ', $items_add->all()).'] scollegati ['.implode(', ', $items_sub->all()).']';
        \Session::flash('status', $status);

        return $this->panel;
    }
}
