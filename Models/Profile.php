<?php

declare(strict_types=1);

namespace Modules\Xot\Models;

// use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Tenant\Services\TenantService;
use Modules\Xot\Contracts\ModelProfileContract;
use Modules\Xot\Contracts\ModelWithUserContract;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Tags\HasTags;

/**
 * Modules\Xot\Models\Profile.
 *
 * @property int                                                                          $id
 * @property string|null                                                                  $post_type
 * @property string|null                                                                  $bio
 * @property \Illuminate\Support\Carbon|null                                              $created_at
 * @property \Illuminate\Support\Carbon|null                                              $updated_at
 * @property string|null                                                                  $created_by
 * @property string|null                                                                  $updated_by
 * @property string|null                                                                  $deleted_by
 * @property string|null                                                                  $firstname
 * @property string|null                                                                  $surname
 * @property string|null                                                                  $email
 * @property string|null                                                                  $phone
 * @property string|null                                                                  $address
 * @property int|null                                                                     $user_id
 * @property string|null                                                                  $premise
 * @property string|null                                                                  $premise_short
 * @property string|null                                                                  $locality
 * @property string|null                                                                  $locality_short
 * @property string|null                                                                  $postal_town
 * @property string|null                                                                  $postal_town_short
 * @property string|null                                                                  $administrative_area_level_3
 * @property string|null                                                                  $administrative_area_level_3_short
 * @property string|null                                                                  $administrative_area_level_2
 * @property string|null                                                                  $administrative_area_level_2_short
 * @property string|null                                                                  $administrative_area_level_1
 * @property string|null                                                                  $administrative_area_level_1_short
 * @property string|null                                                                  $country
 * @property string|null                                                                  $country_short
 * @property string|null                                                                  $street_number
 * @property string|null                                                                  $street_number_short
 * @property string|null                                                                  $route
 * @property string|null                                                                  $route_short
 * @property string|null                                                                  $postal_code
 * @property string|null                                                                  $postal_code_short
 * @property string|null                                                                  $googleplace_url
 * @property string|null                                                                  $googleplace_url_short
 * @property string|null                                                                  $point_of_interest
 * @property string|null                                                                  $point_of_interest_short
 * @property string|null                                                                  $political
 * @property string|null                                                                  $political_short
 * @property string|null                                                                  $campground
 * @property string|null                                                                  $campground_short
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\LU\Models\Permission> $permissions
 * @property int|null                                                                     $permissions_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\LU\Models\Role>       $roles
 * @property int|null                                                                     $roles_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\Tag\Models\Tag>       $tags
 * @property int|null                                                                     $tags_count
 * @property \Modules\LU\Models\User|null                                                 $user
 *
 * @method static \Modules\Xot\Database\Factories\ProfileFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  query()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereAdministrativeAreaLevel1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereAdministrativeAreaLevel1Short($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereAdministrativeAreaLevel2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereAdministrativeAreaLevel2Short($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereAdministrativeAreaLevel3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereAdministrativeAreaLevel3Short($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereCampground($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereCampgroundShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereCountryShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereGoogleplaceUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereGoogleplaceUrlShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereLocality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereLocalityShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  wherePointOfInterest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  wherePointOfInterestShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  wherePolitical($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  wherePoliticalShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  wherePostType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  wherePostalCodeShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  wherePostalTown($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  wherePostalTownShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  wherePremise($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  wherePremiseShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereRouteShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereStreetNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereStreetNumberShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  withAllTags(\ArrayAccess|\Spatie\Tags\Tag|array|string $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  withAllTagsOfAnyType($tags)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  withAnyTags(\ArrayAccess|\Spatie\Tags\Tag|array|string $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  withAnyTagsOfAnyType($tags)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile  withoutTags(\ArrayAccess|\Spatie\Tags\Tag|array|string $tags, ?string $type = null)
 *
 * @mixin \Eloquent
 */
class Profile extends BaseModel implements ModelWithUserContract, ModelProfileContract
{
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
    public function user(): BelongsTo
    {
        // $user = TenantService::model('user'); //no bisgna guardare dentro config(auth  etc etc
        // $user_class = \get_class($user);
        $user_class = getUserClass();

        return $this->belongsTo($user_class);
    }
}
