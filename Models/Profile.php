<?php

declare(strict_types=1);

namespace Modules\Xot\Models;

// use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Tenant\Services\TenantService;
use Modules\Xot\Contracts\ModelWithUserContract;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Tags\HasTags;

/**
 * Modules\Xot\Models\Profile.
 *
 * @property int                                                                  $id
 * @property string|null                                                          $post_type
 * @property string|null                                                          $bio
 * @property \Illuminate\Support\Carbon|null                                      $created_at
 * @property \Illuminate\Support\Carbon|null                                      $updated_at
 * @property string|null                                                          $created_by
 * @property string|null                                                          $updated_by
 * @property string|null                                                          $deleted_by
 * @property string|null                                                          $first_name
 * @property string|null                                                          $last_name
 * @property string|null                                                          $email
 * @property string|null                                                          $phone
 * @property string|null                                                          $address
 * @property int|null                                                             $user_id
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\Xot\Models\Image[] $images
 * @property int|null                                                             $images_count
 * @property \Illuminate\Database\Eloquent\Collection|\Spatie\Tags\Tag[]          $tags
 * @property int|null                                                             $tags_count
 * @property \Modules\LU\Models\User|null                                         $user
 *
 * @method static \Modules\Xot\Database\Factories\ProfileFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  query()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  wherePostType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  withAllTags(\ArrayAccess|\Spatie\Tags\Tag|array $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  withAllTagsOfAnyType($tags)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  withAnyTags(\ArrayAccess|\Spatie\Tags\Tag|array $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  withAnyTagsOfAnyType($tags)
 *
 * @mixin \Eloquent
 *
 * @property \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property int|null                                                                        $permissions_count
 * @property \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[]       $roles
 * @property int|null                                                                        $roles_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Profile permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile withoutTags(\ArrayAccess|\Spatie\Tags\Tag|array|string $tags, ?string $type = null)
 */
class Profile extends BaseModel implements ModelWithUserContract {
    // spatie
    use HasRoles;
    use HasTags;

    /**
     * Undocumented variable.
     *
     * @var string
     */
    protected $guard_name = 'web';

    /**
     * @var string[]
     */
    protected $fillable = ['id', 'user_id'];

    /*
     * Undocumented function.
     */
    public function user(): BelongsTo {
        // $user = TenantService::model('user'); //no bisgna guardare dentro config(auth  etc etc
        // $user_class = \get_class($user);
        $user_class = getUserClass();

        return $this->belongsTo($user_class);
    }
}
