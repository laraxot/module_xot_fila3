<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels\Actions;

use Illuminate\Support\Facades\Storage;
use Modules\Theme\Services\ThemeService;

//-------- models -----------

//-------- services --------

//-------- bases -----------

/**
 * Class UploadImageTest.
 */
class UploadImageTestAction extends XotBasePanelAction {
    public bool $onItem = true;

    public bool $onContainer = true;

    /**
     * @return mixed
     */
    public function handle() {
        //$view = $this->panel->view();
        //dddx($view);
        //return ThemeService::view($view);

        //Storage::disk('dropbox')->put('file.txt', 'Contents');
        //return 'preso';
        return $this->panel->view();
    }

    public function postHandle() {
        $data = request()->all();
        dddx($data);
    }
}
