<?php

declare(strict_types=1);

namespace Modules\Xot\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
<<<<<<< HEAD
=======
use Modules\Food\Contracts\BellBoyContract;
use Modules\Food\Models\RestaurantOwner;
>>>>>>> 9472ad4 (first)

/**
 * Modules\Xot\Contracts\ModelContract.
 *
 * @property int                             $id
 * @property int|null                        $user_id
 * @property string|null                     $post_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null                     $created_by
 * @property string|null                     $updated_by
 * @property string|null                     $title
<<<<<<< HEAD
=======
 * @property Collection|BellBoyContract[]    $bellBoys
 * @property Collection|RestaurantOwner[]    $restaurantOwners
>>>>>>> 9472ad4 (first)
 * @property bool                            $is_reclamed
 * @property bool                            $table_enable
 * @property PivotContract|null              $pivot
 * @property string                          $tennant_name
 *
 * @method mixed     getKey()
 * @method string    getRouteKey()
 * @method string    getRouteKeyName()
 * @method string    getTable()
 * @method mixed     with($array)
 * @method array     getFillable()
 * @method mixed     fill($array)
 * @method mixed     getConnection()
 * @method mixed     update($params)
 * @method mixed     delete()
 * @method mixed     detach($params)
 * @method mixed     attach($params)
 * @method mixed     save($params)
 * @method array     treeLabel()
 * @method array     treeSons()
 * @method int       treeSonsCount()
 * @method mixed     bellBoys()
 * @method array     toArray()
 * @method BelongsTo user()
 * @mixin  \Eloquent
 */
<<<<<<< HEAD
interface ModelContract {
}
=======
interface ModelContract
{
}
>>>>>>> 9472ad4 (first)
