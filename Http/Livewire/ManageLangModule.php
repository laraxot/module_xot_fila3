<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Livewire;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Xot\Services\ArrayService;
use Modules\Xot\Services\FileService;
use Nwidart\Modules\Facades\Module;

/**
 * Class ManageLangModule.
 */
<<<<<<< HEAD
class ManageLangModule extends Component {
=======
class ManageLangModule extends Component
{
>>>>>>> 9472ad4 (first)
    public string $module_name;
    public string $lang_name;
    public string $path;

    /**
     * Listener di eventi di Livewire.
     *
     * @var array
     */
    protected $listeners = ['updateArray'];

<<<<<<< HEAD
    public function mount(string $module_name): void {
=======
    public function mount(string $module_name): void
    {
>>>>>>> 9472ad4 (first)
        $this->module_name = $module_name;
        $lang = app()->getLocale();
        $path = Module::getModulePath($this->module_name);
        $path .= 'Resources\lang\\'.$lang.'';
        $path = FileService::fixPath($path);
        $this->path = $path;
    }

    /**
     * Undocumented function.
     */
<<<<<<< HEAD
    public function render(): Renderable {
        // $model->translations  ???
=======
    public function render(): Renderable
    {
        //$model->translations  ???
>>>>>>> 9472ad4 (first)

        $files = File::files($this->path);
        $files = collect($files)->filter(
            function ($file) {
<<<<<<< HEAD
                return 'php' === $file->getExtension();
            }
        );

        /** 
        * @phpstan-var view-string
        */
=======
                return 'php' == $file->getExtension();
            }
        );

>>>>>>> 9472ad4 (first)
        $view = 'xot::livewire.manage_lang_module';
        $view_params = [
            'view' => $view,
            'files' => $files,
            'prefix' => null,
        ];

        return view()->make($view, $view_params);
    }

    /**
     * Undocumented function.
     */
<<<<<<< HEAD
    public function edit(string $lang_name): void {
        $this->lang_name = $lang_name;
        $mod_trad = $this->module_name.'::'.$this->lang_name;
        $form_data = Lang::get($mod_trad, []); // progressioni::prova

        // $form_data = File::getRequire($this->path.'/'.$lang_name.'.php');
=======
    public function edit(string $lang_name): void
    {
        $this->lang_name = $lang_name;
        $mod_trad = $this->module_name.'::'.$this->lang_name;
        $form_data = Lang::get($mod_trad, []); //progressioni::prova

        //$form_data = File::getRequire($this->path.'/'.$lang_name.'.php');
>>>>>>> 9472ad4 (first)

        $this->emit('editModalArray', $form_data);
    }

    /**
     * Undocumented function.
     */
<<<<<<< HEAD
    public function updateArray(array $form_data): void {
=======
    public function updateArray(array $form_data): void
    {
>>>>>>> 9472ad4 (first)
        $filename = $this->path.'/'.$this->lang_name.'.php';
        ArrayService::save(['filename' => $filename, 'data' => $form_data]);
    }
}
