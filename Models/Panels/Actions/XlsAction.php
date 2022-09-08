<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels\Actions;

<<<<<<< HEAD
// -------- models -----------

// -------- services --------
use Modules\Xot\Services\ArrayService;

// -------- bases -----------
=======
//-------- models -----------

//-------- services --------
use Modules\Xot\Services\ArrayService;

//-------- bases -----------
>>>>>>> 9472ad4 (first)

/**
 * Class XlsAction.
 */
<<<<<<< HEAD
class XlsAction extends XotBasePanelAction {
    public bool $onContainer = true; // onlyContainer
=======
class XlsAction extends XotBasePanelAction
{
    public bool $onContainer = true; //onlyContainer
>>>>>>> 9472ad4 (first)

    public string $icon = '<i class="far fa-file-excel fa-1x"></i>';

    /**
<<<<<<< HEAD
     * return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|string|\Symfony\Component\HttpFoundation\BinaryFileResponse
     * @return \Illuminate\Contracts\Support\Renderable|\Symfony\Component\HttpFoundation\BinaryFileResponse. 
     */
    public function handle() {
        $data = ($this->rows->get()->toArray());

        $filename = 'test';

        return ArrayService::make()
=======
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|string|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function handle()
    {
        $data = ($this->rows->get()->toArray());


        $filename='test';
         return ArrayService::make()
>>>>>>> 9472ad4 (first)
            ->setArray($data)
            ->setFilename($filename)
            ->toXls();
    }
}