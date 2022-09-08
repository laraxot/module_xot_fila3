<?php
<<<<<<< HEAD

declare(strict_types=1);

namespace Modules\Xot\Models\Panels\Policies;

class ProfilePanelPolicy extends XotBasePanelPolicy {
=======
namespace Modules\Xot\Models\Panels\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\LU\Models\User as User;
use Modules\Xot\Models\Panels\Policies\ProfilePanelPolicy as Panel;

use Modules\Xot\Models\Panels\Policies\XotBasePanelPolicy;

class ProfilePanelPolicy extends XotBasePanelPolicy
{
>>>>>>> 9472ad4 (first)
}
