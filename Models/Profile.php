<?php

declare(strict_types=1);

namespace Modules\Xot\Models;

// use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Tenant\Services\TenantService;
use Modules\Xot\Contracts\ModelWithUserContract;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Tags\HasTags;

/**
 * Modules\Xot\Models\Profile
 *
 * @property int $id
 * @property string|null $post_type
 * @property string|null $bio
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property string|null $firstname
 * @property string|null $surname
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $address
 * @property int|null $user_id
 * @property string|null $guid
 * @property int|null $video_credits
 * @property int|null $clip_credits
 * @property int|null $clip_max_time
 * @property string|null $review_cost
 * @property int|null $review_unit_time
 * @property int|null $max_search_days
 * @property int|null $max_alerts
 * @property int|null $moderator_id
 * @property int $parent_id
 * @property string|null $image_src
 * @property-read string|null $lang
 * @property string|null $subtitle
 * @property string|null $title
 * @property string|null $txt
 * @property-read string|null $user_handle
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Xot\Models\Image[] $images
 * @property-read int|null $images_count
 * @property-read \Modules\Lang\Models\Post|null $post
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Lang\Models\Post[] $posts
 * @property-read int|null $posts_count
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\Tag\Models\Tag[] $tags
 * @property-write mixed $url
 * @property-read int|null $tags_count
 * @property-read \Modules\LU\Models\User|null $user
 * @method static \Modules\Xot\Database\Factories\ProfileFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModelLang ofItem(string $guid)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile query()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereClipCredits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereClipMaxTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereGuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereMaxAlerts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereMaxSearchDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereModeratorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePostType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereReviewCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereReviewUnitTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUserId($value)
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereVideoCredits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile withAllTags(\ArrayAccess|\Spatie\Tags\Tag|array $tags, ?string $type = null)
=======
=======
>>>>>>> 57d9e85 (.)
=======
>>>>>>> 4463e87 (.)
=======
>>>>>>> ea52768 (.)
<<<<<<< HEAD
 * @method static \Illuminate\Database\Eloquent\Builder|Profile withAllTags($tags, ?string $type = null)
=======
=======
>>>>>>> 35a481d (up)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereVideoCredits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile withAllTags(\ArrayAccess|\Spatie\Tags\Tag|array $tags, ?string $type = null)
>>>>>>> 35a481d (up)
<<<<<<< HEAD
>>>>>>> 2991146 (.)
=======
=======
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereVideoCredits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile withAllTags(\ArrayAccess|\Spatie\Tags\Tag|array $tags, ?string $type = null)
>>>>>>> 8ff221d (up)
<<<<<<< HEAD
>>>>>>> 57d9e85 (.)
=======
=======
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereVideoCredits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile withAllTags(\ArrayAccess|\Spatie\Tags\Tag|array $tags, ?string $type = null)
>>>>>>> 8ff221d (up)
>>>>>>> ea52768 (.)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile withAllTagsOfAnyType($tags)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile withAnyTags(\ArrayAccess|\Spatie\Tags\Tag|array $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile withAnyTagsOfAnyType($tags)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModelLang withPost(string $guid)
 * @mixin \Eloquent
 */
class Profile extends BaseModelLang implements ModelWithUserContract{
    use HasTags; //spatie
    /**
     * @var string[]
     */
    protected $fillable = ['id', 'user_id'];

    /**
     * Undocumented function.
     */
    public function user(): BelongsTo {
        $user = TenantService::model('user');
        $user_class = \get_class($user);

        return $this->belongsTo($user_class);
    }
}