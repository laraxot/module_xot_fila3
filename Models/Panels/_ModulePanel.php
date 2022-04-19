<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels;

/**
 * Class _ModulePanel.
 */
class _ModulePanel extends XotBasePanel {
    /**
     * Get the actions available for the resource.
     */
    public function actions(): array {
        return [
            new Actions\XlsImportAction(),
            new Actions\ModelGeneratorAction(),
        ];
    }
}