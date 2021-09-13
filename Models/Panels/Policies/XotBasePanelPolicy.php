<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
//use Illuminate\Contracts\Auth\UserProvider as User;
use Modules\LU\Services\ProfileService;
use Modules\Xot\Contracts\PanelContract;
use Modules\Xot\Contracts\UserContract;

/**
 * Class XotBasePanelPolicy.
 */
abstract class XotBasePanelPolicy {
    use HandlesAuthorization;

    /**
     * @param UserContract $user
     * @param string       $ability
     *
     * @return bool|null
     */
    //*
    public function before($user, $ability) {
        //dddx(ProfileService::get($user)->isSuperAdmin()); // Modules\LU\Services\ProfileService
        if (is_object($user) && ProfileService::get($user)->isSuperAdmin()) {
            return true;
        }

        return null;
    }

    //*/
    /*
    public function artisan(?UserContract $user, PanelContract $panel): bool {
        return false;
    }
    */

    public function index(?UserContract $user, PanelContract $panel): bool {
        return true;
    }

    public function show(?UserContract $user, PanelContract $panel): bool {
        return true;
    }

    public function create(UserContract $user, PanelContract $panel): bool {
        return true;
    }

    public function edit(UserContract $user, PanelContract $panel): bool {
        return $panel->isRevisionBy($user);
    }

    public function update(UserContract $user, PanelContract $panel): bool {
        return $panel->isRevisionBy($user);
    }

    public function store(UserContract $user, PanelContract $panel): bool {
        /*
        return $panel->isRevisionBy($user);
        non e' stato creato.. percio' sempre false
        */
        return true;
    }

    public function indexAttach(UserContract $user, PanelContract $panel): bool {
        return true;
    }

    public function indexEdit(UserContract $user, PanelContract $panel): bool {
        return true;
    }

    /**
     * @return false
     */
    public function updateTranslate(UserContract $user, PanelContract $panel): bool {
        return false; //update-translate di @can()
    }

    public function destroy(UserContract $user, PanelContract $panel): bool {
        return $panel->isRevisionBy($user);
    }

    public function delete(UserContract $user, PanelContract $panel): bool {
        return $panel->isRevisionBy($user);
    }

    public function restore(UserContract $user, PanelContract $panel): bool {
        return $panel->isRevisionBy($user);
    }

    public function forceDelete(UserContract $user, PanelContract $panel): bool {
        return false;
    }

    public function detach(UserContract $user, PanelContract $panel): bool {
        return $panel->isRevisionBy($user);
    }

    public function clone(UserContract $user, PanelContract $panel): bool {
        return true;
    }

    /**
     * Determine whether the user can view any DocDummyPluralModel.
     */
    public function viewAny(UserContract $user): bool {
        return true;
    }

    public function view(UserContract $user, PanelContract $panel): bool {
        return true;
    }
}