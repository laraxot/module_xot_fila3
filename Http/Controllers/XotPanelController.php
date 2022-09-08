<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;

/**
 * Class XotPanelController.
 */
<<<<<<< HEAD
class XotPanelController extends Controller {
=======
class XotPanelController extends Controller
{
>>>>>>> 9472ad4 (first)
    /**
     * @param string $method
     * @param array  $arg
     *
     * @return mixed
     */
<<<<<<< HEAD
    public function __call($method, $arg) {
        // dddx(['name' => $name, 'arg' => $arg]);
=======
    public function __call($method, $arg)
    {
        //dddx(['name' => $name, 'arg' => $arg]);
>>>>>>> 9472ad4 (first)
        /**
         * 0 => xotrequest
         * 1 => userPanel.
         */
        $func = '\Modules\Xot\Jobs\PanelCrud\\'.Str::studly($method).'Job';

        $data = $arg[0];
        if ($arg[0] instanceof Request) {
            $data = $data->all();
        }
<<<<<<< HEAD

        $panel = $func::dispatchNow($data, $arg[1]);
        // dddx($panel);//Modules\Xot\Models\Panels\HomePanel
=======
        $panel = $func::dispatchNow($data, $arg[1]);
>>>>>>> 9472ad4 (first)

        return $panel->out();
    }
}
