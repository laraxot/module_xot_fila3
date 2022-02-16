<?php
/**
 * @see https://medium.com/technology-hits/how-to-import-a-csv-excel-file-in-laravel-d50f93b98aa4
 */

declare(strict_types=1);

namespace Modules\Xot\Services;

use Exception;

/**
 * Class CSVService.
 */
class CSVService {
    /**
     * Undocumented function.
     */
    public static function toArray(string $filename): array {
        $lines = file($filename, FILE_IGNORE_NEW_LINES);
        if (false == $lines) {
            throw new Exception('['.__LINE__.']['.class_basename(__CLASS__).']');
        }
        $csv = [];
        foreach ($lines as $key => $value) {
            $csv[$key] = str_getcsv($value);
        }

        return $csv;
    }
}