<?php

declare(strict_types=1);

namespace Modules\Xot\Models;

class Profile extends BaseModel {
    /**
     * @var string[]
     */
    protected $fillable = ['id', 'auth_user_id'];
}
