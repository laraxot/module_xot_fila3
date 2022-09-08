<?php

declare(strict_types=1);

namespace Modules\Xot\Models;

use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
// use Laravel\Scout\Searchable;
// ---- Traits ----
=======
//use Laravel\Scout\Searchable;
//---- Traits ----
>>>>>>> 9472ad4 (first)
use Modules\Xot\Traits\Updater;

/**
 * Class XotBaseModel.
 */
<<<<<<< HEAD
abstract class XotBaseModel extends Model {
    // use Searchable;
    use Updater;
    /**
     * Indicates whether attributes are snake cased on arrays.
     *
     * @see  https://laravel-news.com/6-eloquent-secrets
     *
     * @var bool
     */
     public static $snakeAttributes = true;

    protected $perPage = 30;
=======
abstract class XotBaseModel extends Model
{
    //use Searchable;
    use Updater;
>>>>>>> 9472ad4 (first)
}
