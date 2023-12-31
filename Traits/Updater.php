<?php

declare(strict_types=1);

namespace Modules\Xot\Traits;

/**
 * Trait Updater.
 * https://dev.to/hasanmn/automatically-update-createdby-and-updatedby-in-laravel-using-bootable-traits-28g9.
 */
trait Updater
{
    /**
     * bootUpdater function.
     */
    protected static function bootUpdater(): void
    {
        /*
         * During a model create Eloquent will also update the updated_at field so
         * need to have the updated_by field here as well.
         */
        static::creating(
            function ($model): void {
                // if (auth()->user() instanceof Authenticatable) {
                $model->created_by = auth()->id();
                $model->updated_by = auth()->id();
                // }
            }
        );

        /*
         * updating.
         */
        static::updating(
            function ($model): void {
                $model->updated_by = auth()->id();
            }
        );
        // -------------------------------------------------------------------------------------
        /*
         * Deleting a model is slightly different than creating or deleting.
         * For deletes we need to save the model first with the deleted_by field
        */
        // *
        static::deleting(function ($model): void {
            if (\in_array('deleted_by', array_keys($model->attributes), true)) {
                $model->deleted_by = auth()->id();
                $model->save();
            }
        });
        // */
        // ----------------------
    }

    // end function boot
}// end trait Updater
