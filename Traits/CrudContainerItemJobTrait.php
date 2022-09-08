<?php

declare(strict_types=1);

namespace Modules\Xot\Traits;

use Illuminate\Support\Str;
use Modules\Xot\Contracts\PanelContract;

/**
 * Trait CrudContainerItemJobTrait.
 */
<<<<<<< HEAD
trait CrudContainerItemJobTrait {
=======
trait CrudContainerItemJobTrait
{
>>>>>>> 9472ad4 (first)
    /**
     * @param string $name
     * @param array  $arg
     *
     * @return PanelContract
     */
<<<<<<< HEAD
    public function __call($name, $arg) {
=======
    public function __call($name, $arg)
    {
>>>>>>> 9472ad4 (first)
        $func = '\Modules\Xot\Jobs\Crud\\'.Str::studly($name).'Job';
        $panel = $func::dispatchNow($arg[1], $arg[2]);

        return $panel;
    }
}
