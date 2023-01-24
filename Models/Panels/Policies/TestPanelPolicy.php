<?php
namespace Modules\Xot\Models\Panels\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\LU\Models\User as User;
use Modules\Xot\Models\Panels\Policies\TestPanelPolicy as Post; 

use Modules\Cms\Models\Panels\Policies\XotBasePanelPolicy;

class TestPanelPolicy extends XotBasePanelPolicy {
}
