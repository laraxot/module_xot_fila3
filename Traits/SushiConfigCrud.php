<?php

declare(strict_types=1);

namespace Modules\Xot\Traits;

<<<<<<< HEAD
/**
 * https://dev.to/hasanmn/automatically-update-createdby-and-updatedby-in-laravel-using-bootable-traits-28g9.
 */
trait SushiConfigCrud {
=======
use Illuminate\Support\Facades\Auth;

/**
 
 * https://dev.to/hasanmn/automatically-update-createdby-and-updatedby-in-laravel-using-bootable-traits-28g9.
 */
trait SushiConfigCrud{
    
>>>>>>> 9472ad4 (first)
    /**
     * bootUpdater function.
     *
     * @return void
     */
<<<<<<< HEAD
    protected static function bootSushiConfigCrud() {
        // parent::boot();
=======
    protected static function bootSushiConfigCrud()
    {
        //parent::boot();
>>>>>>> 9472ad4 (first)
        /*
         * During a model create Eloquent will also update the updated_at field so
         * need to have the updated_by field here as well.
         **/
        static::creating(
            function ($model) {
<<<<<<< HEAD
                $data = [];
                $data['id'] = $model->max('id') + 1;
                $data = array_merge($data, $model->toArray());

                $config_name = $model->config_name;
                if (class_exists('\Modules\Tenant\Services\TenantService')) {
                    $config_name = \Modules\Tenant\Services\TenantService::getName().'/'.$config_name;
                }
                $config_path = config_path($config_name.'.php');

                $original = config($model->config_name);
                if (! \is_array($original)) {
                    $original = [];
                }
                $new = array_merge($original, [$data]);
                $fillable = $model->getFillable();
                $new = collect($new)->map(function ($item) use ($fillable) {
                    foreach ($fillable as $v) {
                        if (! isset($item[$v])) {
                            $item[$v] = null;
                        }
                    }

                    return $item;
                })->all();

                file_put_contents($config_path, '<?php
                    return '.var_export($new, true).';');
                // Artisan::call('cache:clear');
=======
                $data=[];
                $data['id']=$model->max('id')+1;
                $data=array_merge($data,$model->toArray());

                $config_name=$model->config_name;
                if(class_exists('\Modules\Tenant\Services\TenantService')){
                    $config_name=\Modules\Tenant\Services\TenantService::getName().'/'.$config_name;
                }
                $config_path=config_path($config_name.'.php');

                $original=config($model->config_name);
                if(!is_array($original)){
                    $original=[];
                }
                $new=array_merge($original,[$data]);
                $fillable=$model->getFillable();
                $new=collect($new)->map(function($item) use($fillable){
                    foreach($fillable as $v){
                        if(!isset($item[$v])){
                            $item[$v]=null;
                        }
                    }
                    return $item;
                })->all();
                
                
                
                file_put_contents($config_path,'<?php
                    return '.var_export($new,true).';');
                //Artisan::call('cache:clear');
>>>>>>> 9472ad4 (first)
            }
        );

        /*
         * updating.
         */
        static::updating(
            function ($model) {
<<<<<<< HEAD
                $data = $model->toArray();

                $config_name = $model->config_name;
                if (class_exists('\Modules\Tenant\Services\TenantService')) {
                    $config_name = \Modules\Tenant\Services\TenantService::getName().'/'.$config_name;
                }
                $config_path = config_path($config_name.'.php');

                $original = config($model->config_name);
                if (! \is_array($original)) {
                    $original = [];
                }
                $up = collect($original)->groupBy('id')->map(function ($item) {
                    return $item->first();
                })->all();
                $id = $data['id'];
                $up[$id] = $data;

                file_put_contents($config_path, '<?php
                return '.var_export($up, true).';');
            }
        );
        // -------------------------------------------------------------------------------------
=======
               $data=$model->toArray();

               $config_name=$model->config_name;
                if(class_exists('\Modules\Tenant\Services\TenantService')){
                    $config_name=\Modules\Tenant\Services\TenantService::getName().'/'.$config_name;
                }
                $config_path=config_path($config_name.'.php');

                $original=config($model->config_name);
                if(!is_array($original)){
                    $original=[];
                }
                $up=collect($original)->groupBy('id')->map(function($item){
                   return $item->first();
                })->all();
                $id=$data['id'];
                $up[$id]=$data;

                file_put_contents($config_path,'<?php
                return '.var_export($up,true).';');

                

            }
        );
        //-------------------------------------------------------------------------------------
>>>>>>> 9472ad4 (first)
        /*
         * Deleting a model is slightly different than creating or deleting.
         * For deletes we need to save the model first with the deleted_by field
        **/
<<<<<<< HEAD

        static::deleting(function ($model) {
            $data = $model->toArray();

            $config_name = $model->config_name;
            if (class_exists('\Modules\Tenant\Services\TenantService')) {
                $config_name = \Modules\Tenant\Services\TenantService::getName().'/'.$config_name;
            }
            $config_path = config_path($config_name.'.php');

            $original = config($model->config_name);
            if (! \is_array($original)) {
                $original = [];
            }
            $up = collect($original)->groupBy('id')->map(function ($item) {
                return $item->first();
            })->all();
            $id = $data['id'];
            unset($up['id']);

            file_put_contents($config_path, '<?php
             return '.var_export($up, true).';');
        });

        // ----------------------
    }

    // end function boot
}// end trait Updater
=======
       
        static::deleting(function ($model) {
            $data=$model->toArray();

            $config_name=$model->config_name;
             if(class_exists('\Modules\Tenant\Services\TenantService')){
                 $config_name=\Modules\Tenant\Services\TenantService::getName().'/'.$config_name;
             }
             $config_path=config_path($config_name.'.php');

             $original=config($model->config_name);
             if(!is_array($original)){
                 $original=[];
             }
             $up=collect($original)->groupBy('id')->map(function($item){
                return $item->first();
             })->all();
             $id=$data['id'];
             unset($up['id']);

             file_put_contents($config_path,'<?php
             return '.var_export($up,true).';');
           
        });
        
        //----------------------
    }

    //end function boot
}//end trait Updater
>>>>>>> 9472ad4 (first)
