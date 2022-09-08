<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Livewire;

<<<<<<< HEAD
// use Illuminate\Support\Carbon;
=======
//use Illuminate\Support\Carbon;
>>>>>>> 9472ad4 (first)
use Livewire\Component;

/**
 * Class Test.
 */
<<<<<<< HEAD
class Test extends Component {
=======
class Test extends Component
{
>>>>>>> 9472ad4 (first)
    public string $animal = '';

    public array $options;

    public array $products = [];

    public array $change_cats = [];

    public array $changes = [];

    public array $qty = [];

    public array $qty1 = [];

<<<<<<< HEAD
    public function mount(): void {
        $this->options = ['one' => true, 'two' => false, 'three' => false];
        // $this->qty = [0 => -1, 1 => 1, 2 => 0, 3 => 0, 4 => -1];
=======
    /**
     * @return void
     */
    public function mount():void
    {
        $this->options = ['one' => true, 'two' => false, 'three' => false];
        //$this->qty = [0 => -1, 1 => 1, 2 => 0, 3 => 0, 4 => -1];
>>>>>>> 9472ad4 (first)
        $this->products = [
            (object) ['id' => 1, 'title' => 'Margherita'],
            (object) ['id' => 2, 'title' => 'Capricciosa'],
        ];
        $this->change_cats = [
            (object) ['id' => 1, 'title' => 'Formaggi'],
            (object) ['id' => 2, 'title' => 'Salumi'],
        ];
        $this->changes = [
            (object) ['id' => 1, 'id_cat' => 1, 'title' => 'mozzarella'],
            (object) ['id' => 2, 'id_cat' => 1, 'title' => 'gorgonzola'],
            (object) ['id' => 3, 'id_cat' => 2, 'title' => 'salame'],
            (object) ['id' => 4, 'id_cat' => 2, 'title' => 'prosciutto'],
        ];
    }

<<<<<<< HEAD
    public function fix(array $arr): array {
=======
    public function fix(array $arr): array
    {
>>>>>>> 9472ad4 (first)
        return collect($arr)->map(
            function ($item) {
                return (object) $item;
            }
        )->all();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    /**
     * Render the component.
<<<<<<< HEAD
     */
    public function render(): \Illuminate\Contracts\Support\Renderable {
=======
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function render():\Illuminate\Contracts\Support\Renderable
    {
>>>>>>> 9472ad4 (first)
        $view_params = [];
        $this->products = $this->fix($this->products);
        $this->change_cats = $this->fix($this->change_cats);
        $this->changes = $this->fix($this->changes);

        return view()->make('xot::livewire.test', $view_params);
    }
}
