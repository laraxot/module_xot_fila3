<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Model\Update;

use Illuminate\Database\Eloquent\Model;
use Spatie\QueueableAction\QueueableAction;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HasManyAction {
    use QueueableAction;

    public function __construct() {
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function execute(Model $row, \Modules\Xot\DTOs\RelationDTO $relation) {
         
        if (! $relation->rows instanceof HasMany) {
            throw new \Exception('['.__LINE__.']['.__FILE__.']');
        }

        $rows = $relation->rows;
        $rows->update($relation->data);
    }
}
