<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Model\Update;

use Illuminate\Database\Eloquent\Model;
use Spatie\QueueableAction\QueueableAction;

class HasOneAction {
    use QueueableAction;

    public function __construct() {
    }

    /**
     * Undocumented function
     *
     * @param Model $row
     * @param object $relation
     * @return void
     */
    public function execute(Model $row, object $relation) {
        $rows = $relation->rows;
        // $rows= $row->{$relation->name}();
        if ($rows->exists()) {
            if (! \is_array($relation->data)) {
                // variabile uguale alla relazione
            } else {
                // backtrace(true);
                // dddx([$model, $name, $data]);
                $row->{$relation->name}->update($relation->data);
            }
        } else {
            dddx(['err' => 'wip']);
            // $this->storeRelationshipsHasOne($params);
        }
    }
}
