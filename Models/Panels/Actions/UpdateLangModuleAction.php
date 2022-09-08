<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels\Actions;

use Nwidart\Modules\Facades\Module;

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
 * Class ArtisanAction.
 */
<<<<<<< HEAD
class UpdateLangModuleAction extends XotBasePanelAction {
    public bool $onContainer = true; // onlyContainer

    public bool $onItem = true; // onlyContainer
=======
class UpdateLangModuleAction extends XotBasePanelAction
{
    public bool $onContainer = true; //onlyContainer

    public bool $onItem = true; //onlyContainer
>>>>>>> 9472ad4 (first)

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
<<<<<<< HEAD
    public function handle() {
        return 'preso';
    }

    // end handle
=======
    public function handle()
    {
        return 'preso';
    }

    //end handle
>>>>>>> 9472ad4 (first)
}
