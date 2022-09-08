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
 * Class CreateJob.
 */
<<<<<<< HEAD
class CreateJob extends XotBaseJob {
    public function handle(): PanelContract {
=======
class CreateJob extends XotBaseJob
{
    public function handle(): PanelContract
    {
>>>>>>> 9472ad4 (first)
        return $this->panel;
    }
}
