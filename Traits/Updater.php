<?php

declare(strict_types=1);

namespace Modules\Xot\Traits;

use Illuminate\Support\Facades\Auth;

/**
 * Trait Updater.
 * https://dev.to/hasanmn/automatically-update-createdby-and-updatedby-in-laravel-using-bootable-traits-28g9.
 */
<<<<<<< HEAD
trait Updater {
=======
trait Updater
{
>>>>>>> 9472ad4 (first)
    /**
     * Undocumented function.
     * move to modelservice.
     */
    /*

     * move to modelservice.
     */
    /*
    public function getTableColumns(): array {
        return $this->getConnection()
            ->getSchemaBuilder()
            ->getColumnListing($this->getTable());
    }

    /**
     * bootUpdater function.
    */

    /**
     * bootUpdater function.
     *
     * @return void
     */
<<<<<<< HEAD
    protected static function bootUpdater() {
        // parent::boot();
=======
    protected static function bootUpdater()
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
                if (null !== Auth::user()) {
=======
                if (null != Auth::user()) {
>>>>>>> 9472ad4 (first)
                    // Cannot call method getAttribute() on Modules\LU\Models\User|null.
                    // Cannot access property $handle on Modules\LU\Models\User|null.
                    $model->created_by = Auth::user()->handle ?? '';
                    $model->updated_by = Auth::user()->handle ?? '';
                }
            }
        );

        /*
         * updating.
         */
        static::updating(
            function ($model) {
                $model->updated_by = Auth::user()->handle ?? '';
            }
        );
<<<<<<< HEAD
        // -------------------------------------------------------------------------------------
=======
        //-------------------------------------------------------------------------------------
>>>>>>> 9472ad4 (first)
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
<<<<<<< HEAD
        // ----------------------
    }

    // end function boot
}// end trait Updater
=======
        //----------------------
    }

    //end function boot
}//end trait Updater
>>>>>>> 9472ad4 (first)
