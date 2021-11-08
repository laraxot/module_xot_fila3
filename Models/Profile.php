<?php

declare(strict_types=1);

namespace Modules\Xot\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
//use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\LU\Models\User;

class Profile extends BaseModel {
    /**
     * @var string[]
     */
    protected $fillable = ['id', 'user_id'];

    /**
     * Undocumented function.
     */
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}