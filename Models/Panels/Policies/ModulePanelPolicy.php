<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels\Policies;

use Modules\Xot\Contracts\UserContract;

/**
 * --.
 */
class ModulePanelPolicy extends XotBasePanelPolicy {
    /**
     * ---.
     */
    public function downloadDbModule(UserContract $user, PanelContract $panel):bool {
        return true;
    }
}
