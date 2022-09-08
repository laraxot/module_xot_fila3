<?php

declare(strict_types=1);

namespace Modules\Xot\Traits;

<<<<<<< HEAD
use Illuminate\Support\Facades\Auth;

// /laravel/app/Updater.php
// Str::camel() 'foo_bar' fooBar
// kebab_case() 'fooBar'  foo-bar
// snake_case() 'fooBar' foo_bar
// Str::studly() 'foo_bar' FooBar
// title_case() 'a nice title uses the correct case'
=======
// /laravel/app/Updater.php
//Str::camel() 'foo_bar' fooBar
//kebab_case() 'fooBar'  foo-bar
//snake_case() 'fooBar' foo_bar
//Str::studly() 'foo_bar' FooBar
//title_case() 'a nice title uses the correct case'
>>>>>>> 9472ad4 (first)

/**
 * Trait MyLogTrait.
 */
<<<<<<< HEAD
trait MyLogTrait {
    protected static function boot() {
=======
trait MyLogTrait
{
    protected static function boot()
    {
>>>>>>> 9472ad4 (first)
        parent::boot();
        /*
         \Event::listen(['eloquent.*'], function ($a){
            var_dump($a);
        });
        */
        static::creating(
<<<<<<< HEAD
            /**
             * @param Model $model
             */
            function ($model) {
                // dddx(static::$logModel);
                $user = Auth::user();
                if (null !== $user) {
                    $model->created_by = $user->handle;
                    $model->updated_by = $user->handle.'';
                }
                // $model->uuid = (string)Uuid::generate();
=======
            function ($model) {
                //dddx(static::$logModel);
                if (null != \Auth::user()) {
                    $model->created_by = optional(\Auth::user())->handle;
                    $model->updated_by = optional(\Auth::user())->handle.'';
                }
                //$model->uuid = (string)Uuid::generate();
>>>>>>> 9472ad4 (first)
            }
        );

        static::updating(
<<<<<<< HEAD
            /**
             * @param Model $model
             */
            function ($model) {
                // $tmp = ;
                // dddx(debug_backtrace());
                $parz = [];
                $parz['tbl'] = $model->getTable(); // work
                $parz['id_tbl'] = $model->getKey(); // work
                if (\is_object($model)) {
                    $data = collect((array) $model)->filter(
                        function ($value, $key) {
                            $key = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $key);

                            return '*attributes' === $key;
                        }
                    )->values()[0];
                    $parz['data'] = json_encode($data);
=======
            function ($model) {
                //$tmp = ;
                //dddx(debug_backtrace());
                $parz = [];
                $parz['tbl'] = $model->getTable(); //work
                $parz['id_tbl'] = $model->getKey(); //work
                if (\is_object($model)) {
                    $data = collect((array) $model)->filter(
                        function ($value, $key) {
                            $key = \preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $key);

                            return '*attributes' == $key;
                        }
                    )->values()[0];
                    $parz['data'] = \json_encode($data);
>>>>>>> 9472ad4 (first)
                }

                $log = static::$logModel;
                $res = $log::create($parz);

<<<<<<< HEAD
                if (Auth::check()) {
                    $user=Auth::user();
                    if (null != $user) {
                        $model->updated_by = $user->handle.'';
                    }
=======
                if (\Auth::check()) {
                    $model->updated_by = optional(\Auth::user())->handle.'';
>>>>>>> 9472ad4 (first)
                }
            }
        );
    }
}
