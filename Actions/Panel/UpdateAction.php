<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Panel;

use Modules\Xot\Actions\Model\FilterRelations;
use Modules\Xot\Contracts\PanelContract;
use Spatie\ModelInfo\ModelInfo;
use Spatie\QueueableAction\QueueableAction;

class UpdateAction {
    use QueueableAction;

    public function __construct() {
    }

    public function execute(PanelContract $panel, array $data): PanelContract {
        $row = $panel->getRow();
        $rules = $panel->rules(['act' => 'edit']);
        $act = str_replace('\Panel\\', '\Model\\', __CLASS__);
        app('\\'.$act)->execute($row, $data, $rules);
        /*
        $relations = app(FilterRelations::class)->execute($row, array_keys($data));

        $row = tap($row)->update($data);

        foreach ($relations as $relation) {
            $act = __NAMESPACE__.'\\Update\\'.$relation->relationship_type;
            $relation->data = $data[$relation->name];
            app($act)->execute($row, $relation);
        }
        */

        /*
        dddx([
            'data' => $data,
            'relations' => $relations,
        ]);
        */
        /*
        $class = get_class($row);

        $modelInfo = ModelInfo::forModel($row);
        dddx([
            'model_info' => $modelInfo,
            'file_name' => $modelInfo->fileName, // F:\var\www\_bases\base_ptvx\laravel\Modules\LU\Models\Group.php
            'table_name' => $modelInfo->tableName, // liveuser_groups
            'attributes' => $modelInfo->attributes,
            'relations' => $modelInfo->relations,
            'methods' => get_class_methods($modelInfo),
        ]);
        */
        return $panel;
    }
}
