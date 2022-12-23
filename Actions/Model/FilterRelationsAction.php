<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Model;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueueableAction\QueueableAction;
use Illuminate\Database\Eloquent\Relations\Relation;

class FilterRelationsAction {
    use QueueableAction;

    public function __construct() {
    }

    public function execute(Model $model, array $data): Collection {
        $methods = get_class_methods($model);
        $res = collect($data)
        ->filter(
            function ($item) use ($methods) {
                return \in_array($item, $methods, true);
            }
        )
        ->filter(
            function ($item) use ($model) {
                $rows = $model->$item();

                return $rows instanceof Relation;
            }
        )->map(function ($item) use ($model) {
            $rows = $model->$item();
            $related = null;
            if (method_exists($rows, 'getRelated')) {
                $related = $rows->getRelated();
            }

            return (object) [
                'relationship_type' => class_basename($rows),
                'related' => $related,
                'name' => $item,
                'rows' => $rows,
            ];
        });

        return $res;
    }
}
