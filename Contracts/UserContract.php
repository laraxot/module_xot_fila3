<?php

<<<<<<< HEAD
// senza la document delle property phpstan da errore per proprieta' mancante
=======
//senza la document delle property phpstan da errore per proprieta' mancante
>>>>>>> 9472ad4 (first)

declare(strict_types=1);

namespace Modules\Xot\Contracts;

use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use Illuminate\Contracts\Auth\MustVerifyEmail;
=======
>>>>>>> 9472ad4 (first)
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
 * @property \Modules\LU\Models\PermUser|null                                   $perm
 * @mixin    \Eloquent
 */
<<<<<<< HEAD
interface UserContract extends MustVerifyEmail{
=======
interface UserContract
{
>>>>>>> 9472ad4 (first)
    /*
    public function isSuperAdmin();
    public function name();
    public function areas();
    public function avatar();
    */
    public function profile(): HasOne;

    /**
     * Undocumented function.
     *
     * @return bool
     */
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
<<<<<<< HEAD
}
=======
}
>>>>>>> 9472ad4 (first)
