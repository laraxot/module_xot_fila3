<?php

declare(strict_types=1);

namespace Modules\Xot\Models;

// use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Tenant\Services\TenantService;
use Modules\Xot\Contracts\ModelWithUserContract;
use Spatie\Tags\HasTags;

class Profile extends BaseModelLang implements ModelWithUserContract {
    use HasTags; // spatie
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
