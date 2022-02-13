<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels\Actions;

use Nwidart\Modules\Facades\Module;

//-------- models -----------

//-------- services --------
//-------- bases -----------

/**
 * Class ArtisanAction.
 */
class UpdateLangModuleAction extends XotBasePanelAction
{
    public bool $onContainer = true; //onlyContainer

    public bool $onItem = true; //onlyContainer

    public string $icon = '<i class="fas fa-language"></i>';

    public string $module_name;
    /*
    public function __construct(string $module_name) {
        $this->module_name = $module_name;
    }
    */

    /**
     * @return mixed
     */
    public function handle()
    {
        return 'preso';
    }

    //end handle
}
