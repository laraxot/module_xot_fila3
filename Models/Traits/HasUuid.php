<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Traits;

use Illuminate\Support\Str;

/**
 * Undocumented trait
 * https://www.larashout.com/using-uuids-in-laravel-models.
 */
<<<<<<< HEAD
trait HasUuid {
    /**
     * Boot function from Laravel.
     */
    protected static function bootHasUuid() {
        // parent::boot();
=======
trait HasUuid
{
    /**
     * Boot function from Laravel.
     */
    protected static function bootHasUuid()
    {
        //parent::boot();
>>>>>>> 9472ad4 (first)
        static::creating(
            function ($model) {
                if (empty($model->{$model->getKeyName()})) {
                    $model->{$model->getKeyName()} = Str::uuid()->toString();
                }
            }
        );
    }

    /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
<<<<<<< HEAD
    public function getIncrementing() {
=======
    public function getIncrementing()
    {
>>>>>>> 9472ad4 (first)
        return false;
    }

    /**
     * Get the auto-incrementing key type.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getKeyType() {
=======
    public function getKeyType()
    {
>>>>>>> 9472ad4 (first)
        return 'string';
    }
}
