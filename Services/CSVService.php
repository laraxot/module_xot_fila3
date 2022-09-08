<?php
/**
 * @see https://medium.com/technology-hits/how-to-import-a-csv-excel-file-in-laravel-d50f93b98aa4
 */

declare(strict_types=1);

namespace Modules\Xot\Services;

use Exception;
use Illuminate\Support\Collection;

/**
 * Class CSVService.
 */
class CSVService {
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

    /**
     * Undocumented function.
     */
    public static function toArray(string $filename): array {
        $lines = file($filename, FILE_IGNORE_NEW_LINES);
<<<<<<< HEAD
        if (false === $lines) {
=======
        if (false == $lines) {
>>>>>>> 9472ad4 (first)
            throw new Exception('['.__LINE__.']['.class_basename(__CLASS__).']');
        }
        $csv = [];
        foreach ($lines as $key => $value) {
            $csv[$key] = str_getcsv($value);
        }

        return $csv;
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 9472ad4 (first)
