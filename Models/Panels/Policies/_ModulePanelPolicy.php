<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels\Policies;

use Modules\Xot\Contracts\PanelContract;
use Modules\Xot\Contracts\UserContract;

class _ModulePanelPolicy extends XotBasePanelPolicy {
    /**
     * Undocumented function.
     */
    public function chooseAdmTheme(UserContract $user, PanelContract $panel): bool {
        return true;
    }
}
