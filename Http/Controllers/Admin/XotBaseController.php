<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Xot\Traits\CrudContainerItemJobTrait as CrudTrait;

<<<<<<< HEAD
// -- jobs --
=======
//-- jobs --
>>>>>>> 9472ad4 (first)
/*
use Modules\Xot\Jobs\Crud\IndexJob;

use Modules\Xot\Jobs\Crud\editJob;
use Modules\Xot\Jobs\Crud\updateJob;

use Modules\Xot\Jobs\Crud\createJob;
use Modules\Xot\Jobs\Crud\storeJob;
*/

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
    public function __call($name, $arg){
        $func='\Modules\Xot\Jobs\Crud\\'.$name.'Job';
        $panel=$func::dispatchNow($arg[1],$arg[2]);
        return $panel;
    }
    */
}
