<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Modules\LU\Models\Area;
use Modules\Tenant\Services\TenantService;
use Modules\Xot\Contracts\PanelContract;
use Modules\Xot\Contracts\UserContract;
use Nwidart\Modules\Facades\Module;

/**
 * Class ProfileService.
 */
class ProfileService {
    private UserContract $user;

    private ?Model $profile = null;

    private PanelContract $profile_panel;

    private static ?self $instance = null;

    private array $xot;

    public function __construct() {
        // ---
        $xot=config('xra');
        $this->xot=$xot;
    }

    public static function getInstance(): self {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function make(): self {
        return static::getInstance();
    }

    /**
     * Undocumented function
     *
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call($name, $arguments){
        /*
        dddx(
            [
                'name'=>$name,
                'arguments'=>$arguments,
                'profile'=>$this->getProfile(),
                'profile_class'=>get_class($this->getProfile()),
                't1'=>method_exists($this->getProfile(),$name),
            ]
        );
        */
        $profile=$this->getProfile();
        if(method_exists($profile,$name)){
            return $profile->{$name}($arguments);
        }
        throw new Exception('['.__LINE__.']['.class_basename(__CLASS__).']');
    }

    /**
     * @param object|Model|\Modules\Xot\Contracts\UserContract $user
     *
     * @throws \ReflectionException
     */
    public function get($user): self {
        if (\is_object($user)) {
            //$this->xot['main_module'];
            //$profile_model = TenantService::model('profile');
            //$profile_model = app('Modules\\'.$this->xot['main_module'].'\Models\Profile');
            // Strict comparison using === between null and Illuminate\Database\Eloquent\Model will always evaluate to false.
            // if (null === $profile_model) {
            //    dddx('Aggiungi profile a xra.php');
            // }
            if (! $user instanceof UserContract) {
                throw new Exception('['.__LINE__.']['.class_basename(__CLASS__).']');
            }

            $this->user = $user;
            // 51     Dead catch - Exception is never thrown in the try block.
            // try {
            $profile = $user->profile;
            // } catch (\Exception $e) {
            //    echo '<h3>'.$e->getMessage().'</h3>';

            //    return $self;
            // }

            if (null === $profile) {
                /*
                $rows = $user->profile();
                $sql = Str::replaceArray('?', $rows->getBindings(), $rows->toSql());
                dddx([
                    'user' => $user,
                    'sql' => $sql,
                ]);
                */
                $profile = $user->profile()->firstOrCreate();
                $data = ['user_id' => $user->id];
                if (method_exists($profile, 'post')) {
                    $profile->post()->firstOrCreate(['guid' => 'profile-'.$user->id, 'lang' => app()->getLocale()]);
                }
                $profile->save($data);
            }
            /*
            if (null == $profile->updated_by) {
                $profile->updated_by = $user->handle;
                $profile->save();
            }
            */
            $this->profile = $profile;
            $this->profile_panel = PanelService::make()->get($profile);
        }

        return $this;
    }

    public function fullName(): ?string {
        // Strict comparison using === between null and Modules\Xot\Contracts\UserContract will always evaluate to false.
        // if (null === $this->user) {
        //    return null;
        // }
        $user = $this->user;

        // dddx([$user, $user->first_name, property_exists($user, 'first_name')]);

        /*if (! property_exists($user, 'first_name')) {
            throw new \Exception('property first_name in $user not exist');
        }
        if (! property_exists($user, 'last_name')) {
            throw new \Exception('property last_name in $user not exist');
        }*/

        return $user->first_name.' '.$user->last_name;
    }

    public function handle(): string {
        return $this->user->handle;
    }

    public function permType(): int {
        // 89     Access to an undefined property Illuminate\Database\Eloquent\Model::$perm.
        // perchè lo prende come property quando è una relazione?
        // se metto property_exists non visualizzo il sito

        // dddx($this->user->perm->perm_type);
        if (! method_exists($this->user, 'perm')) {
            throw new \Exception('method perm in $this->user not exist');
        }
        /* perm è una relazione
        if (! property_exists($this->user, 'perm')) {
            throw new \Exception('property perm in $this->user not exist');
        }
        */
        if (null === $this->user->perm) {
            return 0;
        }

        return (int) $this->user->perm->perm_type;
        // return (int) optional($this->user->perm)->perm_type;

        // return intval($this->user->getRelationValue('perm')->perm_type);
    }

    public function name(): ?string {
        return $this->user->first_name;
    }

    public function url(string $act = 'show'): string {
        return $this->profile_panel->url($act);
    }

    /**
     * @param int $size
     *
     * @return string|null
     */
    public function avatar($size = 100) {
        // Strict comparison using === between null and Modules\Xot\Contracts\UserContract will always evaluate to false.
        // if (null === $this->user) {
        //    return null;
        // }

        $email = md5(mb_strtolower(trim((string) $this->user->email)));
        $default = urlencode('https://tracker.moodle.org/secure/attachment/30912/f3.png');

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
    // *

    /**
     * @param string $role_name
     *
     * @return bool
     */
    public function hasRole($role_name) {
        if (null === $this->profile) {
            return false;
        }
        $role = $this->role($role_name);

        return \is_object($role);
    }

    /**
     * @param string $role_name
     *
     * @return mixed|null
     */
    public function role($role_name) {
        if (null === $this->profile) {
            return null;
        }
        $role_method = Str::camel($role_name); // bell_boy => bellBoy

        return $this->profile->{$role_method};
    }

    public function email(): ?string {
        return $this->user->email;
    }

    public function getPanel(): PanelContract {
        if (null === $this->profile) {
            // dddx(['message' => 'to fix', 'user' => $this->user, 'profile' => $this->profile]);
            throw new Exception('['.__LINE__.']['.class_basename(__CLASS__).']');
        }

        $profile_panel = PanelService::make()->get($this->profile);

        return $profile_panel;
    }

    public function getProfilePanel(): PanelContract {
        if (null === $this->profile) {
            // dddx(['message' => 'to fix', 'user' => $this->user, 'profile' => $this->profile]);
            throw new Exception('['.__LINE__.']['.class_basename(__CLASS__).']');
        }

        $profile_panel = PanelService::make()->get($this->profile);

        return $profile_panel;
    }

    public function getUserPanel(): PanelContract {
        $model = $this->user->newInstance();
        $user_panel = PanelService::make()->get($model);

        return $user_panel;
    }

    public function isSuperAdmin(array $params = []): bool {
        if (null === $this->profile) {
            return false;
        }
        $panel = $this->getPanel();
        // dddx($panel);//Modules\Food\Models\Panels\ProfilePanel
        if (! method_exists($panel, 'isSuperAdmin')) {
            throw new \Exception('method isSuperAdmin in ['.\get_class($panel).'] not exist');
        }

        return $panel->isSuperAdmin($params);
    }

    public function getUser(): UserContract {
        return $this->user;
    }

    public function getProfile(): ?Model {
        return $this->profile;
    }

    /**
     * Undocumented function.
     *
     * @return Collection<Area>
     */
    public function areas(): Collection {
        $areas = $this->getUser()->areas
            ->sortBy('order_column');

        $modules = Module::getByStatus(1);
        // dddx(['areas' => $areas, 'modules' => $modules]);
        $areas = $areas->filter(
            function ($item) use ($modules) {
                return \in_array($item->area_define_name, array_keys($modules), true);
            }
        );

        return $areas;
    }

    public function hasArea(string $name): bool {
        $area = $this->areas()->firstWhere('area_define_name', $name);
        return \is_object($area);
    }

    public function panelAreas(): Collection {
        return $this->areas()->map(
            function ($area) {
                if (! $area instanceof Model) {
                    throw new Exception('['.__LINE__.']['.__FILE__.']');
                }

                return PanelService::make()->get($area);
            }
        );
    }
}