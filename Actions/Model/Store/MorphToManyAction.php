<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Model\Store;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Spatie\QueueableAction\QueueableAction;

class MorphToManyAction {
    use QueueableAction;

    public function __construct() {
    }

    public function execute(Model $row, object $relation) {
        $data = $relation->data;
        // dddx(['row' => $row, 'relation' => $relation, 't1' => Arr::isAssoc($data)]);

        if (! Arr::isAssoc($data)) {
            $relation->rows->sync($data);

            return;
        }
        dddx('wip');
        /*
        foreach ($data as $k => $v) {
            if (\is_array($v)) {
                if (! isset($v['pivot'])) {
                    $v['pivot'] = [];
                }
                if (! isset($v['pivot']['user_id']) && isset($model->user_id)) {
                    $v['pivot']['user_id'] = $model->user_id;
                }
                if (! isset($v['pivot']['user_id']) && \Auth::check()) {
                    $v['pivot']['user_id'] = \Auth::id();
                }
                $model->$name()->syncWithoutDetaching([$k => $v['pivot']]);
            } else {
                $res = $model->$name()->syncWithoutDetaching([$v]);
            }
        }
        */
    }
}
