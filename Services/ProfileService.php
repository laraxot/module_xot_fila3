<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Modules\Tenant\Services\TenantService;
use Modules\Xot\Contracts\PanelContract;
use Nwidart\Modules\Facades\Module;

/**
 * Class ProfileService.
 */
class ProfileService {
    private Model $user;

    private Model $profile;

    private PanelContract $profile_panel;

    private static ?ProfileService $instance = null;

    public static function getInstance(): self {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param object|Model|\Modules\Xot\Contracts\UserContract $user
     *
     * @throws \ReflectionException
     */
    public static function get($user): self {
        $self = self::getInstance();

        if (is_object($user)) {
            $profile_model = TenantService::model('profile');
            if (null == $profile_model) {
                dddx('Aggiungi profile a xra.php');
            }
            $self->user = $user;
            $profile = $user->profile;

            if (null == $profile) {
                /*
                $rows = $user->profile();
                $sql = Str::replaceArray('?', $rows->getBindings(), $rows->toSql());
                dddx([
                    'user' => $user,
                    'sql' => $sql,
                ]);
                */
                $profile = $user->profile()->create();
                $profile->user_id = $user->id;

                $profile->post()->firstOrCreate(['guid' => 'profile-'.$user->id, 'lang' => app()->getLocale()]);

                $profile->save();
            }
            if (null == $profile->updated_by) {
                $profile->updated_by = $user->handle;
                $profile->save();
            }
            $self->profile = $profile;
            $self->profile_panel = PanelService::get($profile);
        }

        return $self;
    }

    public function fullName(): ?string {
        if (null == $this->user) {
            return null;
        }
        $user = $this->user;

        //dddx([$user, $user->first_name, property_exists($user, 'first_name')]);

        /*if (! property_exists($user, 'first_name')) {
            throw new \Exception('property first_name in $user not exist');
        }
        if (! property_exists($user, 'last_name')) {
            throw new \Exception('property last_name in $user not exist');
        }*/

        return $user->first_name.' '.$user->last_name;
    }

    public function handle(): string {
        return optional($this->user)->handle;
    }

    public function permType(): int {
        // 89     Access to an undefined property Illuminate\Database\Eloquent\Model::$perm.
        // perchè lo prende come property quando è una relazione?
        // se metto property_exists non visualizzo il sito

        //dddx($this->user->perm->perm_type);
        if (! method_exists($this->user, 'perm')) {
            throw new \Exception('method perm in $this->user not exist');
        }
        /* perm è una relazione
        if (! property_exists($this->user, 'perm')) {
            throw new \Exception('property perm in $this->user not exist');
        }
        */

        //return (int) optional($this->user->perm)->perm_type;

        return intval($this->user->getRelationValue('perm')->perm_type);
    }

    public function name(): string {
        return (string) optional($this->user)->first_name;
    }

    public function url(array $params = []): string {
        return $this->profile_panel->url($params);
    }

    /**
     * @param int $size
     *
     * @return string|null
     */
    public function avatar($size = 100) {
        if (null == $this->user) {
            return null;
        }

        $email = \md5(\mb_strtolower(\trim($this->user->email)));
        $default = \urlencode('https://tracker.moodle.org/secure/attachment/30912/f3.png');

        return "https://www.gravatar.com/avatar/$email?d=$default&s=$size";
    }

    /*
    public function profile() {
        $profile = TenantService::model('profile');

        $res = $this->hasOne($profile, 'user_id', 'user_id');
        if ($res->exists()) {
            return $res;
        }
        $res = $profile->firstOrCreate(['user_id' => $this->user_id]);
        $res->post()->firstOrCreate(
            [
                //    'user_id' => $this->user_id,
                'guid' => $this->guid,
                'lang' => app()->getLocale(),
            ], [
                'title' => $this->guid,
            ]
        );

        return $this->profile();
    }
    */
    //*

    /**
     * @param string $role_name
     *
     * @return bool
     */
    public function hasRole($role_name) {
        if (null == $this->profile) {
            return false;
        }
        $role = $this->role($role_name);

        return is_object($role);
    }

    /**
     * @param string $role_name
     *
     * @return mixed|null
     */
    public function role($role_name) {
        if (null == $this->profile) {
            return null;
        }
        $role_method = Str::camel($role_name); //bell_boy => bellBoy

        return $this->profile->{$role_method};
    }

    public function email(): ?string {
        return $this->user->email;
    }

    public function getPanel(): PanelContract {
        if (null == $this->profile) {
            dddx(['message' => 'to fix', 'user' => $this->user, 'profile' => $this->profile]);
        }

        $profile_panel = PanelService::get($this->profile);

        return $profile_panel;
    }

    public function getProfilePanel(): PanelContract {
        if (null == $this->profile) {
            dddx(['message' => 'to fix', 'user' => $this->user, 'profile' => $this->profile]);
        }

        $profile_panel = PanelService::get($this->profile);

        return $profile_panel;
    }

    public function getUserPanel(): PanelContract {
        $user_panel = PanelService::get($this->user);

        return $user_panel;
    }

    public function isSuperAdmin(array $params = []): bool {
        $panel = $this->getPanel();
        //dddx($panel);//Modules\Food\Models\Panels\ProfilePanel
        if (! method_exists($panel, 'isSuperAdmin')) {
            throw new \Exception('method isSuperAdmin in ['.get_class($panel).'] not exist');
        }

        return $panel->isSuperAdmin($params);
    }

    public function getUser(): object {
        return $this->user;
    }

    public function areas(): Collection {
        $areas = $this->getUser()->areas;

        $modules = Module::all();
        //dddx(['areas' => $areas, 'modules' => $modules]);
        $areas = $areas->filter(
            function ($item) use ($modules) {
                return in_array($item->area_define_name, array_keys($modules));
            }
        );

        return $areas;
    }

    public function panelAreas(): Collection {
        return $this->areas()->map(function ($area) {
            return PanelService::get($area);
        });
    }
}
