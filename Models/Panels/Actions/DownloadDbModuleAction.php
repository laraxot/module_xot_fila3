<?php

/**
 * https://github.com/ifsnop/mysqldump-php/blob/master/src/Ifsnop/Mysqldump/Mysqldump.php.
 */

declare(strict_types=1);

namespace Modules\Xot\Models\Panels\Actions;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Xot\Services\FileService;
use Nwidart\Modules\Facades\Module;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

//-------- models -----------

//-------- services --------

//-------- bases -----------

/**
 * Class DownloadDbModuleAction.
 */
class DownloadDbModuleAction extends XotBasePanelAction {
    public bool $onItem = true;

    public string $icon = '<i class="fas fa-database"></i><i class="fas fa-download"></i>';

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle() {
        //$res = '';
        $row = $this->row;
        $name = $row->name;
        $name_low = Str::lower($name);
        //$model = $this->getModel($name);
        //$conn = $model->getConnection();
        $db = config('database.connections.'.$name_low);
        /*
        dddx(
            [
                'db' => $db,
                'model' => get_class_methods($model),
                'conn' => get_class_methods($conn),
            ]
        );
        //*/
        //$pdo = $conn->getPdo();
        //dddx(get_class_methods($pdo));
        //$res = $conn->statement('mysqldump geek_quaeris');
        //dddx($res);
        $filename = 'backup-'.$name.'-'.Carbon::now()->format('Y-m-d').'.gz';
        //$backup_path = storage_path('app/backup/'.$filename);
        $backup_path = Storage::disk('cache')->path('backup/'.$filename);

        $backup_path = FileService::fixPath($backup_path);
        FileService::createDirectoryForFilename($backup_path);

        /*
        $command = 'mysqldump --user='.$db['username'].' --password='.$db['password'].' --host='.$db['host'].' '.$db['database'].'  | gzip > '.$backup_path;
        */

        $process = Process::fromShellCommandline(sprintf(
            'mysqldump --user=%s --password=%s %s > %s',
            $db['username'],
            $db['password'],
            $db['database'],
            $backup_path,
        ));

        try {
            $process->mustRun();
        } catch (ProcessFailedException $exception) {
            //logger()->debug($exception->getMessage());
            //$this->error('The backup process has failed.');
            dddx($exception);
        }

        return response()->download($backup_path);
    }

    public function getModel($module_name) {
        //$module_name=$this->panel->getModuleName();
        $cache_key = Str::slug($module_name.'_model');
        $first_model_class = Cache::rememberForever($cache_key, function () use ($module_name) {
            $module_path = Module::getModulePath($module_name);
            $module_models_path = $module_path.'/Models';
            $models = File::files($module_models_path);
            $i = 0;
            $is_abstract = true;
            while ($is_abstract) {
                $first_model_file = $models[$i++];
                $first_model_class = 'Modules\\'.$module_name.'\Models\\'.Str::before($first_model_file->getBasename(), '.php');
                $reflect = new \ReflectionClass($first_model_class);
                $is_abstract = $reflect->isAbstract();
            }

            return $first_model_class;
        });
        $first_model = app($first_model_class);

        return $first_model;
    }
}
