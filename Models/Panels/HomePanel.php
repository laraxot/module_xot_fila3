<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels;

<<<<<<< HEAD
// --- Services --
=======
//--- Services --
>>>>>>> 9472ad4 (first)

/**
 * Class HomePanel.
 */
class HomePanel extends XotBasePanel {
    /**
     * The model the resource corresponds to.
     */
    public static string $model = 'Modules\Xot\Models\Home';

    /**
     * The single value that should be used to represent the resource when being displayed.
     */
    public static string $title = 'title';

    /**
     * Get the fields displayed by the resource.
        'value'=>'..',
     */
    public function fields(): array {
        return [
        ];
    }

    /**
     * Get the actions available for the resource.
     */
    public function actions(): array {
<<<<<<< HEAD
        /**
         * @var string
         */
        $cmd = request('cmd','');
=======
        $cmd = (string) request('cmd');
>>>>>>> 9472ad4 (first)

        return [
            new Actions\ArtisanAction($cmd),
            new Actions\TestAction(),
        ];
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 9472ad4 (first)
