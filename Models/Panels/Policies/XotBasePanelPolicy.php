<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
// use Illuminate\Contracts\Auth\UserProvider as User;
use Modules\Xot\Contracts\PanelContract;
use Modules\Xot\Contracts\UserContract;
use Modules\Xot\Services\PanelService;
use Modules\Xot\Services\ProfileService;
use Nwidart\Modules\Facades\Module;

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
    // *
    public function before($user, $ability) {
        // * -- togliere per fare debug
        if (\is_object($user)) {
            $route_params = getRouteParameters();

            $profile = ProfileService::make()->get($user);
            if (isset($route_params['module'])) {
                $module = Module::find($route_params['module']);
                $module_name = '';
                if (null != $module) {
                    $module_name = $module->getName();
                }
                $has_area = $profile->hasArea($module_name);

                return $has_area && $profile->isSuperAdmin();
            }
            if ($profile->isSuperAdmin()) {
                return true;
            }
        }
        // */

        return null;
    }

    // */
    /*
    public function artisan(?UserContract $user, PanelContract $panel): bool {
        return false;
    }
    */

    public function home(?UserContract $user, PanelContract $panel): bool {
        if (inAdmin() && null === $user) {
            return false;
        }

        $route_params = $panel->getRouteParams();
        if (isset($route_params['module']) && null != $user) {
            $module = Module::find($route_params['module']);
            $module_name = '';
            if (null != $module) {
                $module_name = $module->getName();
            }

            // $panel = PanelService::make()->get($user);
            // $areas = $panel->areas()->firstWhere('area_define_name', $module->getName());
            // return is_object($areas);

            $profile = ProfileService::make()->get($user);

            return $profile->hasArea($module_name);
        }

        return true;
    }

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

    // test delle tabs
    public function index_edit(UserContract $user, PanelContract $panel): bool {
        return true;
    }

    /**
     * @return false
     */
    public function updateTranslate(UserContract $user, PanelContract $panel): bool {
        return false; // update-translate di @can()
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