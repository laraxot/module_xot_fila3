<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Livewire;

<<<<<<< HEAD
// use Illuminate\Support\Carbon;
=======
//use Illuminate\Support\Carbon;
>>>>>>> 9472ad4 (first)
use Illuminate\Support\Str;
use Livewire\Component;

/**
 * Class XotBaseComponent.
 */
<<<<<<< HEAD
abstract class XotBaseComponent extends Component {
    /**
     * @return string
     */
    public function getView() {
        $class = static::class;
=======
abstract class XotBaseComponent extends Component
{
    /**
     * @return string
     */
    public function getView()
    {
        $class = get_class($this);
>>>>>>> 9472ad4 (first)
        $module_name = Str::between($class, 'Modules\\', '\Http\\');
        $module_name_low = Str::lower($module_name);
        $comp_name = Str::after($class, '\Http\Livewire\\');
        $comp_name = str_replace('\\', '.', $comp_name);
        $comp_name = Str::snake($comp_name);
        $view = $module_name_low.'::livewire.'.$comp_name;
        $view = str_replace('._', '.', $view);
<<<<<<< HEAD
        // fare distinzione fra inAdmin o no ?
        if (! view()->exists($view)) {
            dddx(
                [
                    'err' => 'View not Exists',
                    'view' => $view,
=======
        //fare distinzione fra inAdmin o no ?
        if (! view()->exists($view)) {
            dddx(
                [
                'err' => 'View not Exists',
                'view' => $view,
>>>>>>> 9472ad4 (first)
                ]
            );
        }

        return $view;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    /**
     * Render the component.
<<<<<<< HEAD
     */
    public function render(): \Illuminate\Contracts\Support\Renderable {
        // per fare copia ed incolla
=======
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function render():\Illuminate\Contracts\Support\Renderable
    {
        //per fare copia ed incolla
>>>>>>> 9472ad4 (first)
        $view = $this->getView();
        $view_params = [
            'view' => $view,
        ];

        return view()->make($view, $view_params);
    }
}
