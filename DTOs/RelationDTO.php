<?php

declare(strict_types=1);

namespace Modules\Xot\DTOs;

use Spatie\LaravelData\Data;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Undocumented class.
 */
class RelationDTO extends Data {
    public $rows;

    /**
     * @var int|string|array|null
     */
    public $data;

    public string $name;

    public string $relationship_type;

    public $related;
}
