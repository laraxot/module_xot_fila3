<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Model\Update;

use Illuminate\Database\Eloquent\Model;
use Modules\Xot\Actions\Model\UpdateAction;
use Modules\Xot\DTOs\RelationDTO;
use Spatie\QueueableAction\QueueableAction;

class CustomRelationAction
{
    use QueueableAction;

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function execute(Model $model, RelationDTO $relationDTO): void
    {
        // dddx(['model' => $model, 'relationDTO' => $relationDTO]);
        $models = [];
        $ids = [];
        $related = $relationDTO->related;
        $keyName = $relationDTO->related->getKeyName();
        foreach ($relationDTO->data as $data) {
            if (\in_array($keyName, array_keys($data), true)) {
                $res = app(UpdateAction::class)->execute($related, $data, []);
                $ids[] = $res->getKey();
                $models[] = $res;
            } else {
                dddx(['model' => $model, 'relationDTO' => $relationDTO]);
            }
        }
    }
}
