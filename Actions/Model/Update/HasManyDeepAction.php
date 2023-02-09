<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Model\Update;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Modules\Xot\DTOs\RelationDTO;
use Spatie\QueueableAction\QueueableAction;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;

class HasManyDeepAction {
    use QueueableAction;

    public function __construct() {
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
<<<<<<< HEAD
<<<<<<< HEAD
    public function execute(Model $row, RelationDTO $relation) {
        if (! $relation->rows instanceof HasManyDeep) {
            throw new \Exception('['.__LINE__.']['.__FILE__.']');
        }
=======
    public function execute(Model $row, \Modules\Xot\DTOs\RelationDTO $relation)
    {
>>>>>>> 636f226 (up)
=======
    public function execute(Model $row, \Modules\Xot\DTOs\RelationDTO $relation) {
>>>>>>> 3966014 (Fix styling)
        $data = $relation->data;
        $name = $relation->name;
        $model = $row;

        $modelReflected = new \ReflectionClass($model);
        $modelName = strtolower($modelReflected->getShortName());

        // bisogna prima cancellare le relazioni esistenti per quel model?
        // $model->$name()->detach();
        $model->$name()->getParent()->where('model_type', $modelName)->where('model_id', $model->getKey())->delete();

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

            foreach ($related_ids_to_link as $related_id_to_link) {
                // dati da mettere nella pivot
                $pivot_data = [
                    'model_id' => $model->getKey(),
                    'model_type' => $modelName,
                    $penlastKeyName => $related_id_to_link->getKey(),
                    'user_id' => Auth::id(),
                ];
                $test = $model->$name()->getParent()->fill($pivot_data);

                $test->save();
            }
        }
    }
}
