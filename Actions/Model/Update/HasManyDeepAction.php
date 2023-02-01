<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Model\Update;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\QueueableAction\QueueableAction;

class HasManyDeepAction {
    use QueueableAction;

    public function __construct() {
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function execute(Model $row, \Modules\Xot\DTOs\RelationDTO $relation) {
        $data = $relation->data;
        $name = $relation->name;
        $model = $row;

        // bisogna prima cancellare le relazioni esistenti per quel model?
        $model->$name()->delete();

        if (! is_array($data)) {
            throw new \Exception('['.__LINE__.']['.__FILE__.']');
        }
        if (\in_array('to', array_keys($data), true) || \in_array('from', array_keys($data), true)) {
            if (! isset($data['to'])) {
                $data['to'] = [];
            }
            $data = $data['to'];
        }

        // model_id_to_link = id del modello da collegare (es. group_id di extrafield group)
        foreach ($data as $model_id_to_link) {
            // related id da collegare (es. quello di extra field)
            $lastKeyName = collect($model->$name()->getLocalKeys())->last();
            $penlastKeyName = collect($model->$name()->getLocalKeys())->values()->slice(-2)->first();

            $related_ids_to_link = collect($relation->rows->getThroughParents())->last()->where($lastKeyName, $model_id_to_link)->get();

            $modelReflected = new \ReflectionClass($model);
            $modelName = strtolower($modelReflected->getShortName());

            foreach ($related_ids_to_link as $related_id_to_link) {
                // dati da mettere nella pivot
                $pivot_data = [
                    'model_id' => $model->id,
                    'model_type' => $modelName,
                    $penlastKeyName => $related_id_to_link->id,
                    'user_id' => Auth::id(),
                ];
                $test = $model->$name()->getParent()->fill($pivot_data);

                $test->save();
            }
        }
    }
}
