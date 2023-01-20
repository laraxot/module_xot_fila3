<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Model\Store;

use Modules\Xot\DTOs\RelationDTO;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\QueueableAction\QueueableAction;

class HasManyAction {
    use QueueableAction;

    public function __construct() {
    }

    public function execute(Model $row, RelationDTO $relation): void {
        
        if (! $relation->rows instanceof HasMany) {
            throw new \Exception('['.__LINE__.']['.__FILE__.']');
        }

        $rows = $relation->rows;
        $rows->create($relation->data);
    }
}
