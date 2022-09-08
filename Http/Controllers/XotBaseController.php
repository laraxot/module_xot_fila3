<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Xot\Traits\CrudContainerItemJobTrait as CrudTrait;

/**
 * Class XotBaseController.
 */
<<<<<<< HEAD
abstract class XotBaseController extends Controller {
=======
abstract class XotBaseController extends Controller
{
>>>>>>> 9472ad4 (first)
    use CrudTrait;
    /*
    public function __call($name, $arg)
    {
        $func  = 'Modules\Xot\Jobs\Crud\\' . Str::studly($name) . 'Job';
        $panel = $func::dispatchNow($arg[1], $arg[2]);
        return $panel;
    }
    */
}
