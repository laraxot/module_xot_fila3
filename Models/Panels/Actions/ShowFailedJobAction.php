<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels\Actions;

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
 * Class ShowFailedJobAction.
 */
class ShowFailedJobAction extends XotBasePanelAction {
<<<<<<< HEAD
    public bool $onContainer = false; // onlyContainer

    public bool $onItem = true; // onlyContainer
=======
    public bool $onContainer = false; //onlyContainer

    public bool $onItem = true; //onlyContainer
>>>>>>> 9472ad4 (first)

    public string $icon = '<i class="far fa-file-excel fa-1x"></i>';

    protected string $cmd;

    protected array $cmd_params;

    /**
     * ArtisanAction constructor.
     */
    public function __construct() {
    }

    /**
     * @return mixed
     */
    public function handle() {
        dddx($this->panel->row);
    }

<<<<<<< HEAD
    // end handle
=======
    //end handle
>>>>>>> 9472ad4 (first)
}
