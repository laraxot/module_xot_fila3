<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Model\Store;

use Illuminate\Database\Eloquent\Model;
use Spatie\QueueableAction\QueueableAction;

class BelongsToAction {
    use QueueableAction;

    public function __construct() {
    }

    public function execute(Model $row, object $relation) {
        if (null == $row->{$relation->name}) {
            $row->{$relation->name}()->create($relation->data);

            return;
        }
        dddx([
            'message' => 'wip',
            'row' => $row,
            'relation' => $relation,
            'relation_rows' => $relation->rows->exists(),
            't' => $row->{$relation->name},
        ]);
    }
}
