<<<<<<< HEAD
<?php

namespace Modules\Xot\Models\Panels\Actions;

//-------- models -----------

//-------- services --------
use Modules\Xot\Services\ArrayService;

//-------- bases -----------

/**
 * Class XlsAction.
 */
class XlsAction extends XotBasePanelAction {
    public bool $onContainer = true; //onlyContainer

    public string $icon = '<i class="far fa-file-excel fa-1x"></i>';

    /**
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|string|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function handle() {
        $data = ($this->rows->get()->toArray());

        return ArrayService::toXls(['data' => $data, 'filename' => 'test']);
    }
=======
<?php

namespace Modules\Xot\Models\Panels\Actions;

//-------- models -----------

//-------- services --------
use Modules\Xot\Services\ArrayService;

//-------- bases -----------

/**
 * Class XlsAction.
 */
class XlsAction extends XotBasePanelAction {
    public bool $onContainer = true; //onlyContainer

    public string $icon = '<i class="far fa-file-excel fa-1x"></i>';

    /**
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|string|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function handle() {
        $data = ($this->rows->get()->toArray());

        return ArrayService::toXls(['data' => $data, 'filename' => 'test']);
    }
>>>>>>> 3c97c308c85924a62f31c89c71edfe23450749f0
}