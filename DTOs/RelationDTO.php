<?php

declare(strict_types=1);

namespace Modules\Xot\DTOs;

use Spatie\LaravelData\Data;
use Illuminate\Database\Eloquent\Collection;

/**
 * Undocumented class.
 */
class RelationDTO extends Data {
    public Collection $rows;

    /**
     * @var null|int|string|array
     */
    public $data;

    public string $name;
    

    
}
