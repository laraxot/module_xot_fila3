<?php

declare(strict_types=1);

namespace Modules\Xot\Traits;

use Illuminate\Support\Facades\Auth;

/**
 * Trait Updater.
 * https://dev.to/hasanmn/automatically-update-createdby-and-updatedby-in-laravel-using-bootable-traits-28g9.
 */
trait Updater {
    /**
     * Undocumented function.
     */
    public function getTableColumns(): array {
        return $this->getConnection()
            ->getSchemaBuilder()
            ->getColumnListing($this->getTable());
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    protected static function bootUpdater() {
        //parent::boot();
        /**
         * During a model create Eloquent will also update the updated_at field so
         * need to have the updated_by field here as well.
         **/
        static::creating(function ($model) {
            if (null != Auth::user()) {
                // Cannot call method getAttribute() on Modules\LU\Models\User|null.
                // Cannot access property $handle on Modules\LU\Models\User|null.
                $model->created_by = optional(Auth::user())->handle.'';
                $model->updated_by = optional(Auth::user())->handle.'';
            }
        });

        /**
         * updating.
         */
        static::updating(function ($model) {
            if (Auth::check()) {
                $model->updated_by = optional(Auth::user())->handle.'';
            }
        });
        //-------------------------------------------------------------------------------------
        /*
         * Deleting a model is slightly different than creating or deleting.
         * For deletes we need to save the model first with the deleted_by field
        **/
        /*
        static::deleting(function ($model) {
            $model->deleted_by = \Auth::user()->handle;
            $model->save();
        });
        */
        //----------------------
    }

    //end function boot
}//end trait Updater
