<?php

declare(strict_types=1);

namespace Modules\Xot\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\LU\Models\User;

class Profile extends BaseModel {
    /**
     * @var string[]
     */
    protected $fillable = ['id', 'auth_user_id'];

    /**
     * Undocumented function.
     */
    public function user(): HasOne {
        return $this->hasOne(User::class, 'auth_user_id', 'auth_user_id');
    }
}
