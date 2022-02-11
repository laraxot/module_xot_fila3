<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Livewire;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Xot\Services\ArrayService;
use Modules\Xot\Services\FileService;
use Nwidart\Modules\Facades\Module;

/**
 * Class ManageLangModule.
 */
class ManageLangModule extends Component {
    public string $module_name;
    public string $lang_name;
    public string $path;

    /**
     * Listener di eventi di Livewire.
     *
     * @var array
     */
    protected $listeners = ['updateArray'];

    public function mount(string $module_name): void {
        $this->module_name = $module_name;
        $lang = app()->getLocale();
        $path = Module::getModulePath($this->module_name);
        $path .= 'Resources\lang\\'.$lang.'';
        $path = FileService::fixPath($path);
        $this->path = $path;
    }

    public function render():\Illuminate\Contracts\Support\Renderable {
        //$model->translations  ???

        $files = File::files($this->path);
        $files = collect($files)->filter(
            function ($file) {
                return 'php' == $file->getExtension();
            }
        );

        $view = 'xot::livewire.manage_lang_module';
        $view_params = [
            'view' => $view,
            'files' => $files,
            'prefix' => null,
        ];

        return view()->make($view, $view_params);
    }

    public function edit(string $lang_name) {
        $this->lang_name = $lang_name;
        $mod_trad = $this->module_name.'::'.$this->lang_name;
        $form_data = Lang::get($mod_trad, []); //progressioni::prova

        //$form_data = File::getRequire($this->path.'/'.$lang_name.'.php');

        $this->emit('editModalArray', $form_data);
    }

    public function updateArray(array $form_data) {
        $filename = $this->path.'/'.$this->lang_name.'.php';
        ArrayService::save(['filename' => $filename, 'data' => $form_data]);
    }
}
