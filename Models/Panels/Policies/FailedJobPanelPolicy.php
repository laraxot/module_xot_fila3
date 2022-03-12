<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels\Policies;

class FailedJobPanelPolicy extends XotBasePanelPolicy {
    public function artisanContainer(?UserContract $user, PanelContract $panel): bool {
        return true;
    }
}
