<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
//use Illuminate\Database\Eloquent\Model as Post;
//use Modules\LU\Models\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Xot\Contracts\UserContract;
use Modules\Xot\Services\PanelService;
use Modules\Xot\Services\ProfileService;

/**
 * Class XotBasePolicy.
 */
abstract class XotBasePolicy {
    use HandlesAuthorization;

    /**
     * @param UserContract $user
     * @param string       $ability
     *
     * @return bool|null
     */
    public function before(?UserContract $user, $ability) {
        /*
        if (is_object($user) && PanelService::make()->get($user)->isSuperAdmin()) {
            return true;
        }

        return false;
        */
        if (null == $user) {
            return null;
        }

        return ProfileService::make()->get($user)->isSuperAdmin();
    }

    public function index(?UserContract $user, Model $post): bool {
        return true;
    }

    public function show(?UserContract $user, Model $post): bool {
        return true;
    }

    public function create(UserContract $user, Model $post): bool {
        return true;
    }

    public function edit(UserContract $user, Model $post): bool {
        //return true;
        return PanelService::make()->get($post)->isRevisionBy($user);
    }

    public function update(UserContract $user, Model $post): bool {
        return PanelService::make()->get($post)->isRevisionBy($user);
    }

    public function store(UserContract $user, Model $post): bool {
        /*
        if ($post->created_by == $user->handle || $post->updated_by == $user->handle) {
            return true;
        }
        return false;
        non e' stato creato..
        */
        return true;
    }

    public function indexAttach(UserContract $user, Model $post): bool {
        return true;
    }

    public function indexEdit(UserContract $user, Model $post): bool {
        return true;
    }

    /**
     * @return false
     */
    public function updateTranslate(UserContract $user, Model $post): bool {
        return false; //update-translate di @can()
    }

    public function destroy(UserContract $user, Model $post): bool {
        return PanelService::make()->get($post)->isRevisionBy($user);
    }

    public function delete(UserContract $user, Model $post): bool {
        return PanelService::make()->get($post)->isRevisionBy($user);
    }

    public function restore(UserContract $user, Model $post): bool {
        return PanelService::make()->get($post)->isRevisionBy($user);
    }

    /*
    public function forceDelete(UserContract $user, Model $post): bool {
    }
    */
    public function detach(UserContract $user, Model $post): bool {
        return PanelService::make()->get($post)->isRevisionBy($user);
    }

    public function clone(UserContract $user, Model $post): bool {
        return true;
    }

    /*
     * Determine whether the user can view any DocDummyPluralModel.
     */
    /*
    public function viewAny(UserContract $user): bool {
    }
    */
    /*
    public function view(UserContract $user, Model $post): bool {
    }
    */
}
