<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

/**
 * Class FactoryService.
 */
class FactoryService {
    /**
     * Create a new factory instance for the model.
     */
    public static function newFactory(string $called_class): Factory {
        //$called_class = get_called_class();
        $model_name = class_basename($called_class);
        $module_name = Str::between($called_class, 'Modules\\', '\\Models\\');

        $factory_class = Str::replace('\Models\\', '\Database\Factories\\', $called_class).'Factory';

        if (class_exists($factory_class)) {
            return $factory_class::new();
        }
        $res = Artisan::call('module:make-factory', ['name' => $model_name, 'module' => $module_name]);

        throw new Exception('Generating Factory press [F5] to refresh page ['.__LINE__.']['.__FILE__.']');
    }
}