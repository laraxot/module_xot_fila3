<?php
/**
 * @see https://medium.com/technology-hits/how-to-import-a-csv-excel-file-in-laravel-d50f93b98aa4
 */

declare(strict_types=1);

namespace Modules\Xot\Services;

<<<<<<< HEAD
=======
use Exception;
>>>>>>> 9472ad4 (first)
use Illuminate\Support\Collection;

/**
 * Class ConfigService.
 */
class ConfigService {
    protected Collection $data;
    private static ?self $instance = null;

    public function __construct() {
<<<<<<< HEAD
        // ---
        // require_once __DIR__.'/vendor/autoload.php';
=======
        //---
        //require_once __DIR__.'/vendor/autoload.php';
>>>>>>> 9472ad4 (first)
    }

    /**
     * Undocumented function.
     */
    public static function getInstance(): self {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Undocumented function.
     */
    public static function make(): self {
        return static::getInstance();
    }
<<<<<<< HEAD
}
=======

}
>>>>>>> 9472ad4 (first)
