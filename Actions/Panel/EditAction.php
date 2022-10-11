<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Panel;

use Modules\Xot\Contracts\PanelContract;
use Spatie\QueueableAction\QueueableAction;

class EditAction {
    use QueueableAction;

    public function __construct() {
    }

    public function execute(PanelContract $panel, array $data): PanelContract {
        return $panel;
    }
}
