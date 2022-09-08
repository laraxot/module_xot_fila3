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
use Modules\Xot\Services\ArtisanService;

/**
 * Class ArtisanAction.
 */
<<<<<<< HEAD
class ArtisanAction extends XotBasePanelAction {
    public bool $onContainer = false; // onlyContainer

    public bool $onItem = true; // onlyContainer
=======
class ArtisanAction extends XotBasePanelAction
{
    public bool $onContainer = false; //onlyContainer

    public bool $onItem = true; //onlyContainer
>>>>>>> 9472ad4 (first)

    public string $icon = '<i class="far fa-file-excel fa-1x"></i>';

    protected string $cmd;

    protected array $cmd_params;

    /**
     * ArtisanAction constructor.
     */
<<<<<<< HEAD
    public function __construct(string $cmd, array $cmd_params = []) {
=======
    public function __construct(string $cmd, array $cmd_params = [])
    {
>>>>>>> 9472ad4 (first)
        $this->cmd = $cmd;
        $this->cmd_params = $cmd_params;
    }

    /**
     * @return mixed
     */
<<<<<<< HEAD
    public function handle() {
=======
    public function handle()
    {
>>>>>>> 9472ad4 (first)
        $out = ArtisanService::act($this->cmd);

        return $out;
    }

<<<<<<< HEAD
    // end handle
=======
    //end handle
>>>>>>> 9472ad4 (first)
}
