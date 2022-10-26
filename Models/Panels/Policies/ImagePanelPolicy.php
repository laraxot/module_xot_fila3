<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels\Policies;

/**
 * Class ImagePanelPolicy.
 */
class ImagePanelPolicy extends XotBasePanelPolicy
{
    public function store(\Modules\Xot\Contracts\UserContract $user, \Modules\Xot\Contracts\PanelContract $panel): bool
    {
        return true; // da aggiungere pezzi
    }
}
