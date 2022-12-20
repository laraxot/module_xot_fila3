<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Model\Update;

use Illuminate\Database\Eloquent\Model;
use Spatie\QueueableAction\QueueableAction;

class HasManyDeepAction {
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
        dddx('wip');
    }
}
