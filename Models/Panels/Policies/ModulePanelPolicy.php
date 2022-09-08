<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels\Policies;

use Modules\Xot\Contracts\UserContract;
<<<<<<< HEAD
use Modules\Xot\Contracts\PanelContract;
=======
>>>>>>> 9472ad4 (first)

/**
 * --.
 */
class ModulePanelPolicy extends XotBasePanelPolicy {
    /**
     * ---.
     */
<<<<<<< HEAD
    public function downloadDbModule(UserContract $user, PanelContract $panel):bool {
=======
    public function downloadDbModule(UserContract $user, PanelContract $panel) {
>>>>>>> 9472ad4 (first)
        return true;
    }
}
