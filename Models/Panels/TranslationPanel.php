<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels;

<<<<<<< HEAD
// --- Services --
=======
//--- Services --
>>>>>>> 9472ad4 (first)

/**
 * Class TranslationPanel.
 */
<<<<<<< HEAD
class TranslationPanel extends XotBasePanel {
=======
class TranslationPanel extends XotBasePanel
{
>>>>>>> 9472ad4 (first)
    /**
     * The model the resource corresponds to.
     */
    protected static string $model = 'Modules\Xot\Models\Translation';

    /**
     * Undocumented function.
     */
<<<<<<< HEAD
    public function actions(): array {
=======
    public function actions(): array
    {
>>>>>>> 9472ad4 (first)
        return [
            new Actions\ClearDuplicatesTransAction(),
        ];
    }
}
