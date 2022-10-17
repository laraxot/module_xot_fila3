<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Model\Update;

use Illuminate\Database\Eloquent\Model;
use Spatie\QueueableAction\QueueableAction;

class BelongsToAction {
    use QueueableAction;

    public function __construct() {
    }

    public function execute(Model $row, object $relation) {
        $rows = $relation->rows;
        // $rows= $row->{$relation->name}();
        if (! \is_array($relation->data)) {
            $related = $rows->getRelated();
            $related = $related->find($relation->data);
            $res = $rows->associate($related);
            $res->save();

            return;
        }

        if ($rows->exists()) {
            $model->{$relation->name}()->update($relation->data);
        } else {
            dddx(['err' => 'wip']);
        }
    }
}
