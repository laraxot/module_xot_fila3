<<<<<<< HEAD
<?php

namespace Modules\Xot\Models\Panels\Policies;

/**
 * Class ImagePanelPolicy
 * @package Modules\Xot\Models\Panels\Policies
 */
class ImagePanelPolicy extends XotBasePanelPolicy {
    /**
     * @param \Modules\Xot\Contracts\UserContract $user
     * @param \Modules\Xot\Contracts\PanelContract $panel
     * @return bool
     */
    public function store(\Modules\Xot\Contracts\UserContract $user, \Modules\Xot\Contracts\PanelContract $panel):bool {
        return true; //da aggiungere pezzi
    }
}
=======
<?php

namespace Modules\Xot\Models\Panels\Policies;

/**
 * Class ImagePanelPolicy
 * @package Modules\Xot\Models\Panels\Policies
 */
class ImagePanelPolicy extends XotBasePanelPolicy {
    /**
     * @param \Modules\Xot\Contracts\UserContract $user
     * @param \Modules\Xot\Contracts\PanelContract $panel
     * @return bool
     */
    public function store(\Modules\Xot\Contracts\UserContract $user, \Modules\Xot\Contracts\PanelContract $panel):bool {
        return true; //da aggiungere pezzi
    }
}
>>>>>>> 3c97c308c85924a62f31c89c71edfe23450749f0
