<<<<<<< HEAD
<?php

namespace Modules\Xot\Models\Panels\Policies;

use Modules\Xot\Contracts\PanelContract;
use Modules\Xot\Contracts\UserContract;

/**
 * Class TranslationPanelPolicy
 * @package Modules\Xot\Models\Panels\Policies
 */
class TranslationPanelPolicy extends XotBasePanelPolicy {
    /**
     * @param UserContract $user
     * @param PanelContract $panel
     * @return bool
     */
    public function clearDuplicatesTrans(UserContract $user, PanelContract $panel):bool {
        return true;
    }
}
=======
<?php

namespace Modules\Xot\Models\Panels\Policies;

use Modules\Xot\Contracts\PanelContract;
use Modules\Xot\Contracts\UserContract;

/**
 * Class TranslationPanelPolicy
 * @package Modules\Xot\Models\Panels\Policies
 */
class TranslationPanelPolicy extends XotBasePanelPolicy {
    /**
     * @param UserContract $user
     * @param PanelContract $panel
     * @return bool
     */
    public function clearDuplicatesTrans(UserContract $user, PanelContract $panel):bool {
        return true;
    }
}
>>>>>>> 3c97c308c85924a62f31c89c71edfe23450749f0
