<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Model\Store;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Xot\Datas\RelationData as RelationDTO;
use Spatie\QueueableAction\QueueableAction;

class BelongsToAction
{
    use QueueableAction;

    public function execute(Model $model, RelationDTO $relationDTO): void
    {
        if (! $relationDTO->rows instanceof BelongsTo) {
            throw new \Exception('['.__LINE__.']['.class_basename($this).']');
        }

        $related = $relationDTO->rows->create($relationDTO->data);

        $relationDTO->rows->associate($related);

        // $rows = $relation->rows;

        // dd([$relation->name]);
        /*
        if (null == $row->{$relation->name}) {
            $row->{$relation->name}()->create($relation->data);

            return;
        }
        */
        /*
        dddx([
            'message' => 'wip',
            'row' => $row,
            'relation' => $relation,
            'relation_rows' => $relation->rows->exists(),
            't' => $row->{$relation->name},
            't1'=>$rows,
        ]);
        */
    }
}
