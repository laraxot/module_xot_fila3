<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

//---- services ----

/**
 * Class ImageService.
 */
class ImageService {
    private static ?self $instance = null;

    public static function getInstance(): self {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function make(): self {
        return static::getInstance();
    }
}
