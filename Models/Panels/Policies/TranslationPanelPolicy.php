<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels\Policies;

use Modules\Xot\Contracts\PanelContract;
use Modules\Xot\Contracts\UserContract;

/**
 * Class TranslationPanelPolicy.
 */
class TranslationPanelPolicy extends XotBasePanelPolicy {
    public function clearDuplicatesTrans(UserContract $user, PanelContract $panel): bool {
        return true;
    }
}
