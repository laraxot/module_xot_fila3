<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

/**
 * Class CSVService.
 */
class CSVService {
    /**
     * Undocumented function.
     */
    public static function toArray(string $filename): array {
        $lines = file($filename, FILE_IGNORE_NEW_LINES);

        $csv = [];
        foreach ($lines as $key => $value) {
            $csv[$key] = str_getcsv($value);
        }

        return $csv;
    }
}
