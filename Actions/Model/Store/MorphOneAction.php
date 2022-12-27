<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Model\Store;

use Exception;
use Modules\Xot\DTOs\RelationDTO;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueueableAction\QueueableAction;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class MorphOneAction {
    use QueueableAction;

    public function __construct() {
    }

    public function execute(Model $row, RelationDTO $relation): void {
        // if (is_string($relation->data) && isJson($relation->data)) {
        //    $relation->data = json_decode($relation->data, true);
        // }
        if(!$relation->rows instanceof MorphOne){
            throw new Exception('['.__LINE__.']['.__FILE__.']');
        }
        $rows = $relation->rows;
        if ($rows->exists()) {
            // dddx('SI');
            $rows->update($relation->data);
        } else {
            // dddx($relation->data);
            $rows->create($relation->data);
        }
    }
}
