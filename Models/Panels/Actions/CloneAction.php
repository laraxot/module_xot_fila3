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
 * Class CloneAction.
 */
<<<<<<< HEAD
class CloneAction extends XotBasePanelAction {
=======
class CloneAction extends XotBasePanelAction
{
>>>>>>> 9472ad4 (first)
    public bool $onItem = true;

    public string $icon = '<i class="far fa-clone"></i>';

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
<<<<<<< HEAD
    public function handle() {
=======
    public function handle()
    {
>>>>>>> 9472ad4 (first)
        $cloned = $this->row->replicate();
        $cloned->push();

        return redirect()->back();
    }
}
