<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\File;

use Spatie\QueueableAction\QueueableAction;

/**
 * moved from fileservice.
 */
class FixPathAction
{
    use QueueableAction;

    public function execute(string $path): string
    {
        return str_replace(['/', '\\'], [\DIRECTORY_SEPARATOR, \DIRECTORY_SEPARATOR], $path);
    }
}
