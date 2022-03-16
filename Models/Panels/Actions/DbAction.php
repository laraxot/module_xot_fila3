<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels\Actions;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Nwidart\Modules\Facades\Module;
use Illuminate\Support\Facades\File;
use Modules\Xot\Services\ModelService;
use Modules\Theme\Services\ThemeService;

//-------- models -----------

//-------- services --------

//-------- bases -----------

/**
 * Class CloneAction.
 */
class DbAction extends XotBasePanelAction
{
    public bool $onItem = true;

    public string $icon = '<i class="fas fa-database"></i>';

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(){
        //k$database=config('database');
        $data=$this->getAllTablesAndFields();
        $view='xot::admin.home.acts.db';
        $view_params=[
            'view'=>$view,
            'rows'=>$data,
        ];
        return view()->make($view,$view_params);

   }

   public function postHandle(){
        $search=request('search');
        $data=$this->getAllTablesAndFields();
        $data=$data->map(function($item) use($search){
            //da finire
        });
   }

   public function getAllTablesAndFields():Collection{
        $module_name=$this->panel->getModuleName();
        $module_path=Module::getModulePath($module_name);
        $module_models_path=$module_path.'/Models';
        $models=File::files($module_models_path);
        $first_model_file=$models[0];
        $first_model_class='Modules\\'.$module_name.'\Models\\'.Str::before($first_model_file->getBasename(),'.php');
        $first_model=app($first_model_class);
        $data=ModelService::make()->setModel($first_model)->getAllTablesAndFields();
        return $data;
   }

}