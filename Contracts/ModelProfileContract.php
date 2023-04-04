<?php

declare(strict_types=1);

namespace Modules\Xot\Contracts;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;

/**
 * Modules\Xot\Contracts\ModelProfileContract.
 *
 * @property int                             $id
 * @property int|null                        $user_id
 * @property string|null                     $post_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null                     $created_by
 * @property string|null                     $updated_by
 * @property string|null                     $title
 * @property string|null                     $full_name
 * @property string|null                     $org_info
 * @property array|null                      $children
 * @property string|null                     $title
 * @property PivotContract|null              $pivot
 * @property string                          $tennant_name
 * @property \Modules\LU\Models\User|null    $user
 * @property string                          $activity_report_interval
 * @property Collection<Clip>                $clips
 *
 * @method MorphToMany   notifyThemes()
 * @method mixed         getKey()
 * @method string        getRouteKey()
 * @method string        getRouteKeyName()
 * @method string        getTable()
 * @method mixed         with($array)
 * @method array         getFillable()
 * @method mixed         fill($array)
 * @method mixed         getConnection()
 * @method mixed         update($params)
 * @method mixed         delete()
 * @method mixed         detach($params)
 * @method mixed         attach($params)
 * @method mixed         save($params)
 * @method array         treeLabel()
 * @method array         treeSons()
 * @method int           treeSonsCount()
 * @method mixed         bellBoys()
 * @method array         toArray()
 * @method BelongsTo     user()
 * @method HasMany       alerts()
 * @method HasMany       presses()
 * @method BelongsToMany channels()
 * @method mixed         getAttributeValue(string $key)
 * @method Collection    tagsWithType(string $type=null)
 *
 * @mixin  \Eloquent
 *
 * @property int                                        $id
 * @property string|null                                $post_type
 * @property string|null                                $bio
 * @property \Illuminate\Support\Carbon|null            $created_at
 * @property \Illuminate\Support\Carbon|null            $updated_at
 * @property string|null                                $created_by
 * @property string|null                                $updated_by
 * @property string|null                                $deleted_by
 * @property string|null                                $first_name
 * @property string|null                                $last_name
 * @property string|null                                $email
 * @property string|null                                $phone
 * @property string|null                                $address
 * @property int|null                                   $user_id
 * @property string|null                                $github_username
 * @property string|null                                $twitter
 * @property int|null                                   $video_credits
 * @property int|null                                   $clip_credits
 * @property int|null                                   $clip_max_time
 * @property int|null                                   $max_clips
 * @property string|null                                $review_cost
 * @property int|null                                   $review_unit_time
 * @property int|null                                   $max_search_days
 * @property int|null                                   $max_alerts
 * @property int|null                                   $moderator_id
 * @property int                                        $parent_id
 * @property string|null                                $guid
 * @property string|null                                $date_from
 * @property string|null                                $date_to
 * @property string                                     $interval
 * @property string|null                                $units_qty
 * @property string|null                                $units
 * @property string|null                                $first_name
 * @property mixed                                      $last_name
 * @property string|null                                $txt
 * @property int|null                                   $alerts_count
 * @property Collection|Article[]                       $articles
 * @property int|null                                   $articles_count
 * @property int|null                                   $channels_count
 * @property string|null                                $full_name
 * @property string|null                                $image_src
 * @property string|null                                $lang
 * @property string                                     $status
 * @property string|null                                $subtitle
 * @property string|null                                $title
 * @property string|null                                $user_handle
 * @property Collection|\Modules\Xot\Models\Image[]     $images
 * @property int|null                                   $images_count
 * @property Collection|\Modules\LU\Models\Permission[] $permissions
 * @property int|null                                   $permissions_count
 * @property Collection|Place[]                         $places
 * @property int|null                                   $places_count
 * @property \Modules\Lang\Models\Post|null             $post
 * @property Collection|\Modules\Lang\Models\Post[]     $posts
 * @property int|null                                   $posts_count
 * @property int|null                                   $presses_count
 * @property Profile|null                               $profile
 * @property Collection|\Modules\LU\Models\Role[]       $roles
 * @property int|null                                   $roles_count
 * @property Collection|Tag[]                           $tags
 * @property mixed                                      $url
 * @property Collection|\Spatie\ModelStatus\Status[]    $statuses
 * @property int|null                                   $statuses_count
 * @property int|null                                   $tags_count
 * @property User|null                                  $user
 * @property Collection<DistributionList>               $distributionLists
 *
 * @method        HasMany                                             distributionLists()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModelLang currentStatus(...$names)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModelLang ofItem(string $guid)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModelLang otherCurrentStatus(...$names)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       query()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       whereClipCredits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       whereClipMaxTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       whereDateFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       whereDateTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       whereGithubUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       whereGuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       whereInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       whereMaxAlerts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       whereMaxClips($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       whereMaxSearchDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       whereModeratorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       wherePostType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       whereReviewCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       whereReviewUnitTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       whereTwitter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       whereUnits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       whereUnitsQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       whereVideoCredits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       withAllTags(\ArrayAccess|\Spatie\Tags\Tag|array $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       withAllTagsOfAnyType($tags)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       withAnyTags(\ArrayAccess|\Spatie\Tags\Tag|array $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile       withAnyTagsOfAnyType($tags)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModelLang withPost(string $guid)
 *
 * @mixin \Eloquent
 *
 * @property int|null                               $_rgt
 * @property int|null                               $_lft
 * @property string|null                            $last_search
 * @property string                                 $activity_report_interval
 * @property \Kalnoy\Nestedset\Collection|Profile[] $children
 * @property int|null                               $children_count
 * @property int|null                               $clips_count
 * @property int|null                               $distribution_lists_count
 * @property string|null                            $org_info
 * @property Collection|NotifyTheme[]               $notifyThemes
 * @property int|null                               $notify_themes_count
 * @property ModelProfileContract|null              $parent
 *
 * @method static \Kalnoy\Nestedset\Collection|static[]  all($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile ancestorsAndSelf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile ancestorsOf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile applyNestedSetScope(?string $table = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile countErrors()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile d()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile defaultOrder(string $dir = 'asc')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile descendantsAndSelf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile descendantsOf($id, array $columns = [], $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile fixSubtree($root)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile fixTree($root = null)
 * @method static \Kalnoy\Nestedset\Collection|static[]  get($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile getNodeData($id, $required = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile getPlainNodeData($id, $required = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile getTotalErrors()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile hasChildren()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile hasParent()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile isBroken()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile leaves(array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile makeGap(int $cut, int $height)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile moveNode($key, $position)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile orWhereAncestorOf(bool $id, bool $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile orWhereDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile orWhereNodeBetween($values)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile orWhereNotDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile rebuildSubtree($root, array $data, $delete = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile rebuildTree(array $data, $delete = false, $root = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile reversed()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile root(array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile whereActivityReportInterval($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile whereAncestorOf($id, $andSelf = false, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile whereAncestorOrSelf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile whereDescendantOf($id, $boolean = 'and', $not = false, $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile whereDescendantOrSelf(string $id, string $boolean = 'and', string $not = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile whereFirstName($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile whereFullName($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile whereIsAfter($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile whereIsBefore($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile whereIsLeaf()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile whereIsRoot()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile whereLastName($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile whereLastSearch($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile whereLft($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile whereNodeBetween($values, $boolean = 'and', $not = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile whereNotDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile whereRgt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile withDepth(string $as = 'depth')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile withoutRoot()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Profile withoutTags(\ArrayAccess|\Spatie\Tags\Tag|array|string $tags, ?string $type = null)
 */
interface ModelProfileContract
{
    /**
     * Grant the given permission(s) to a role.
     *
     * @param string|int|array|\Spatie\Permission\Contracts\Permission|\Illuminate\Support\Collection $permissions
     *
     * @return $this
     */
    public function givePermissionTo(...$permissions);

    /**
     * Assign the given role to the model.
     *
     * @param array|string|int|\Spatie\Permission\Contracts\Role|\Illuminate\Support\Collection ...$roles
     *
     * @return $this
     */
    public function assignRole(...$roles);

    /**
     * Determine if the model has (one of) the given role(s).
     *
     * @param string|int|array|\Spatie\Permission\Contracts\Role|\Illuminate\Support\Collection $roles
     */
    public function hasRole($roles, string $guard = null): bool;

    /**
     * Determine if the model has any of the given role(s).
     *
     * Alias to hasRole() but without Guard controls
     *
     * @param string|int|array|\Spatie\Permission\Contracts\Role|\Illuminate\Support\Collection $roles
     */
    public function hasAnyRole(...$roles): bool;

    /**
     * Determine if the model may perform the given permission.
     *
     * @param string|int|\Spatie\Permission\Contracts\Permission $permission
     * @param string|null                                        $guardName
     *
     * @throws PermissionDoesNotExist
     */
    public function hasPermissionTo($permission, $guardName = null): bool;
}
