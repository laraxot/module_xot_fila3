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
        //dddx(request()->file('test_image'));

        if (request()->hasFile('test_image')) {
            //get filename with extension
            $filenamewithextension = request()->file('test_image')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = request()->file('test_image')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;

            //Upload File to external server
            Storage::disk('infinityfree')->put($filenametostore, $filename);

        //Store $filenametostore in the database
        } else {
            dddx('niente');
        }
    }
}
