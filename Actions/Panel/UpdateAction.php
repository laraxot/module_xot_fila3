<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Panel;

use Modules\Xot\Contracts\PanelContract;
use Spatie\QueueableAction\QueueableAction;

class UpdateAction
{
    use QueueableAction;

    public function __construct()
    {
    }

    public function execute(PanelContract $panel, array $data): PanelContract
    {
        $row = $panel->getRow();

        $rules = $panel->rules(['act' => 'edit']);
        $act = str_replace('\Panel\\', '\Model\\', __CLASS__);
        app('\\'.$act)->execute($row, $data, $rules);

        return $panel;
    }
}
