<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels\Policies;

class TestPanelPolicy extends XotBasePanelPolicy {
    public function testMail(UserContract $user, PanelContract $panel): bool {
        return true;
    }
}
