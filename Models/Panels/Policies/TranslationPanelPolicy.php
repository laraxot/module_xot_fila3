<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels\Policies;

use Modules\Xot\Contracts\PanelContract;
use Modules\Xot\Contracts\UserContract;

/**
 * Class TranslationPanelPolicy.
 */
<<<<<<< HEAD
class TranslationPanelPolicy extends XotBasePanelPolicy {
    public function clearDuplicatesTrans(UserContract $user, PanelContract $panel): bool {
=======
class TranslationPanelPolicy extends XotBasePanelPolicy
{
    public function clearDuplicatesTrans(UserContract $user, PanelContract $panel): bool
    {
>>>>>>> 9472ad4 (first)
        return true;
    }
}
