<?php

declare(strict_types=1);

namespace Modules\Xot\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
//use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\LU\Models\User;
use Modules\Tenant\Services\TenantService;

class Profile extends BaseModel {
    /**
     * @var string[]
     */
    protected $fillable = ['id', 'user_id'];

    /**
     * Undocumented function.
     */
    public function user(): BelongsTo {
        $user = TenantService::model('user');
        $user_class = get_class($user);

        return $this->belongsTo($user_class);
    }
}