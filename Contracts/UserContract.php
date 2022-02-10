<?php

//senza la document delle property phpstan da errore per proprieta' mancante

declare(strict_types=1);

namespace Modules\Xot\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Modules\LU\Contracts\UserContract.
 *
 * @property Model|null                                                         $profile
 * @property int                                                                $id
 * @property string                                                             $handle
 * @property string|null                                                        $first_name
 * @property string|null                                                        $last_name
 * @property string|null                                                        $email
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\LU\Models\Area[] $areas
 * @mixin \Eloquent
 */
interface UserContract {
    /*
    public function isSuperAdmin();
    public function name();
    public function areas();
    public function avatar();
    */
    public function profile(): HasOne;

    public function update(array $attributes = [], array $options = []);

    /**
     * Get a relationship.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function getRelationValue($key);

    /**
     * Undocumented function.
     *
     * @return Model
     */
    public function newInstance();
}
