<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

/**
 * Class CSVService.
 */
class CSVService {
    public static function toArray($filename): array {
        $lines = file($filename, FILE_IGNORE_NEW_LINES);

        
        foreach ($lines as $key => $value) {
            $csv[$key] = str_getcsv($value);
        }

        return $csv;
    }
}
