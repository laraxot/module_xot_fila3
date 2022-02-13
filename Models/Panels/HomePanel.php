<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels;

//--- Services --

/**
 * Class HomePanel.
 */
class HomePanel extends XotBasePanel
{
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
    public function fields(): array
    {
        return [
        ];
    }

    /**
     * Get the actions available for the resource.
     */
    public function actions(): array
    {
        $cmd = (string) request()->input('cmd');

        return [
            new Actions\ArtisanAction($cmd),
            new Actions\TestAction(),
        ];
    }
}
