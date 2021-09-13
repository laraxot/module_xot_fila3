<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels\Actions;

use Illuminate\Support\Facades\Storage;

//-------- models -----------

//-------- services --------

//-------- bases -----------

/**
 * Class TestAction.
 */
class TestAction extends XotBasePanelAction {
    public bool $onItem = true;

    public bool $onContainer = true;

    /**
     * @return mixed
     */
    public function handle() {
        //Storage::disk('dropbox')->put('file.txt', 'Contents');
        //return 'preso';
        //return $this->panel->view();
    }
}
