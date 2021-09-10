<?php

declare(strict_types=1);

namespace Modules\Xot\Traits;

// /laravel/app/Updater.php
//Str::camel() 'foo_bar' fooBar
//kebab_case() 'fooBar'  foo-bar
//snake_case() 'fooBar' foo_bar
//Str::studly() 'foo_bar' FooBar
//title_case() 'a nice title uses the correct case'

/**
 * Trait MyLogTrait.
 */
trait MyLogTrait {
    protected static function boot() {
        parent::boot();
        /*
         \Event::listen(['eloquent.*'], function ($a){
            var_dump($a);
        });
        */
        static::creating(function ($model) {
            //dddx(static::$logModel);
            if (null != \Auth::user()) {
                $model->created_by = optional(\Auth::user())->handle;
                $model->updated_by = optional(\Auth::user())->handle.'';
            }
            //$model->uuid = (string)Uuid::generate();
        });

        static::updating(function ($model) {
            //$tmp = ;
            //dddx(debug_backtrace());
            $parz = [];
            $parz['tbl'] = $model->getTable(); //work
            $parz['id_tbl'] = $model->getKey(); //work
            if (\is_object($model)) {
                $data = collect((array) $model)->filter(function ($value, $key) {
                    $key = \preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $key);

                    return '*attributes' == $key;
                })->values()[0];
                $parz['data'] = \json_encode($data);
            }

            $log = static::$logModel;
            $res = $log::create($parz);

            if (\Auth::check()) {
                $model->updated_by = optional(\Auth::user())->handle.'';
            }
        });
    }
}
