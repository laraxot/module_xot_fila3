<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels\Actions;

use Illuminate\Support\Facades\File;
use Modules\Xot\Services\ArrayService;
use Nwidart\Modules\Facades\Module;

/**
 * Class ClearDuplicatesTransAction.
 */
<<<<<<< HEAD
class ClearDuplicatesTransAction extends XotBasePanelAction {
=======
class ClearDuplicatesTransAction extends XotBasePanelAction
{
>>>>>>> 9472ad4 (first)
    public bool $onContainer = true;

    public string $icon = '<i class="fas fa-hammer"></i>';

<<<<<<< HEAD
    public function handle(): void {
        // return 'qui';
        $modules = Module::all();
        foreach ($modules as $module) {
            // echo '<br/>'.$module->getPath('Resources/lang');
            // dddx(get_class_methods($module));
            $lang_path = $module->getPath().'/Resources/lang';
            $lang_path = str_replace(['/', '\\'], [\DIRECTORY_SEPARATOR, \DIRECTORY_SEPARATOR], $lang_path);
=======
    public function handle(): void
    {
        //return 'qui';
        $modules = Module::all();
        foreach ($modules as $module) {
            //echo '<br/>'.$module->getPath('Resources/lang');
            //dddx(get_class_methods($module));
            $lang_path = $module->getPath().'/Resources/lang';
            $lang_path = str_replace(['/', '\\'], [DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR], $lang_path);
>>>>>>> 9472ad4 (first)
            echo '<br/>'.$lang_path;
            $files = File::allFiles($lang_path);
            $this->fixFiles($files);
        }
    }

<<<<<<< HEAD
    public function fixFiles(array $files): void {
=======
    public function fixFiles(array $files): void
    {
>>>>>>> 9472ad4 (first)
        foreach ($files as $file) {
            $path = $file->getRealPath();
            try {
                $trads = include $path;
                ArrayService::save(['data' => $trads, 'filename' => $path]);
            } catch (\Exception $e) {
                $err = [
                    'err' => $e->getMessage(),
                    'filename' => $path,
                ];
                echo '<pre>'.print_r($err, true).'</pre>';
            }
            echo '<br>'.$path;
        }
    }
}
