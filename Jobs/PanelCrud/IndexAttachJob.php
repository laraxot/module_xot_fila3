<?php

declare(strict_types=1);

namespace Modules\Xot\Jobs\PanelCrud;

<<<<<<< HEAD
use Exception;
use Modules\Xot\Contracts\PanelContract;

// ----------- Requests ----------
// ------------ services ----------
=======
use Modules\Xot\Contracts\PanelContract;

//----------- Requests ----------
//------------ services ----------
>>>>>>> 9472ad4 (first)

/**
 * Class IndexAttachJob.
 */
<<<<<<< HEAD
class IndexAttachJob extends XotBaseJob {
    public function handle(): PanelContract {
        if ('POST' === \Request::getMethod()) {
            //$this->panel = IndexStoreAttachJob::dispatchNow($this->data, $this->panel);
            throw new Exception('['.__LINE__.']['.__FILE__.']');
=======
class IndexAttachJob extends XotBaseJob
{
    public function handle(): PanelContract
    {
        if ('POST' == \Request::getMethod()) {
            $this->panel = IndexStoreAttachJob::dispatchNow($this->data, $this->panel);
>>>>>>> 9472ad4 (first)
        }

        return $this->panel;
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 9472ad4 (first)
