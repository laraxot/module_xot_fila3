<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels\Actions;

use Illuminate\Support\Facades\Storage;

<<<<<<< HEAD
// -------- models -----------

// -------- services --------

// -------- bases -----------
=======
//-------- models -----------

//-------- services --------

//-------- bases -----------
>>>>>>> 9472ad4 (first)

/**
 * Class TestAction.
 */
<<<<<<< HEAD
class TestAction extends XotBasePanelAction {
=======
class TestAction extends XotBasePanelAction
{
>>>>>>> 9472ad4 (first)
    public bool $onItem = true;

    public bool $onContainer = true;

    /**
     * @return mixed
     */
<<<<<<< HEAD
    public function handle() {
        // Storage::disk('dropbox')->put('file.txt', 'Contents');
        // return 'preso';
        // return $this->panel->view();
=======
    public function handle()
    {
        //Storage::disk('dropbox')->put('file.txt', 'Contents');
        //return 'preso';
        //return $this->panel->view();
>>>>>>> 9472ad4 (first)
    }
}
