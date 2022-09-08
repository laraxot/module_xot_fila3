<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels\Actions;

use Illuminate\Support\Facades\File;
use Modules\Xot\Services\FileService;
use Nwidart\Modules\Facades\Module;

<<<<<<< HEAD
// -------- models -----------

// -------- services --------
// -------- bases -----------
=======
//-------- models -----------

//-------- services --------
//-------- bases -----------
>>>>>>> 9472ad4 (first)

/**
 * Class ArtisanAction.
 */
<<<<<<< HEAD
class ManageLangModuleAction extends XotBasePanelAction {
    public bool $onContainer = true; // onlyContainer

    public bool $onItem = true; // onlyContainer
=======
class ManageLangModuleAction extends XotBasePanelAction
{
    public bool $onContainer = true; //onlyContainer

    public bool $onItem = true; //onlyContainer
>>>>>>> 9472ad4 (first)

    public string $icon = '<i class="fas fa-language"></i>';

    public string $module_name;

<<<<<<< HEAD
    public function __construct(string $module_name) {
=======
    public function __construct(string $module_name)
    {
>>>>>>> 9472ad4 (first)
        $this->module_name = $module_name;
    }

    /**
     * @return mixed
     */
<<<<<<< HEAD
    public function handle() {
=======
    public function handle()
    {
>>>>>>> 9472ad4 (first)
        /*$module = Module::find($this->module_name);
        dddx(
            [
                'module' => $module,
                'Module::getModulePath(name);' => Module::getModulePath($this->module_name),
                'Module::assetPath(name);' => Module::assetPath($this->module_name),

                //'getUsedStoragePath' => $module->getUsedStoragePath(),//Laravel\Module::getUsedStoragePath does not exist.
                //'getAssetsPath' => $module->getAssetsPath(),//dart\Modules\Laravel\Module::getAssetsPath does not exist.
            ]);
        */
        /*
        $lang = app()->getLocale();
        $path = Module::getModulePath($this->module_name);
        $path .= 'Resources\lang\\'.$lang.'';
        $path = FileService::fixPath($path);

        $files = File::files($path);
        */
        $view_params = [
<<<<<<< HEAD
            // 'files' => $files,
=======
            //'files' => $files,
>>>>>>> 9472ad4 (first)
            'module_name' => $this->module_name,
        ];

        return $this->panel->view()->with($view_params);
    }

<<<<<<< HEAD
    // end handle
=======
    //end handle
>>>>>>> 9472ad4 (first)
}
