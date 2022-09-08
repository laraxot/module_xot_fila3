<?php

declare(strict_types=1);

namespace Modules\Xot\View\Components\Dashboard;

use Illuminate\View\Component;

<<<<<<< HEAD
// use Modules\Xot\View\Components\XotBaseComponent;
=======
//use Modules\Xot\View\Components\XotBaseComponent;
>>>>>>> 9472ad4 (first)

/**
 * Class Field.
 */
<<<<<<< HEAD
class Item extends Component {
    public function render(): \Illuminate\Contracts\Support\Renderable {
        /** 
        * @phpstan-var view-string
        */
=======
class Item extends Component
{
    public function render():\Illuminate\Contracts\Support\Renderable
    {
>>>>>>> 9472ad4 (first)
        $view = 'xot::components.dashboard.item';
        $view_params = [
            'view' => $view,
        ];

        return view()->make($view, $view_params);
    }
}
