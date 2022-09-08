<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels;

use Illuminate\Http\Request;

<<<<<<< HEAD
// --- Services --
=======
//--- Services --
>>>>>>> 9472ad4 (first)

/**
 * Class ImagePanel.
 */
<<<<<<< HEAD
class ImagePanel extends XotBasePanel {
=======
class ImagePanel extends XotBasePanel
{
>>>>>>> 9472ad4 (first)
    /**
     * The model the resource corresponds to.
     */
    protected static string $model = 'Modules\Xot\Models\Image';

    /**
     * The single value that should be used to represent the resource when being displayed.
     */
    protected static string $title = 'title';

    /**
     * Get the actions available for the resource.
     */
<<<<<<< HEAD
    public function actions(Request $request = null): array {
=======
    public function actions(Request $request = null): array
    {
>>>>>>> 9472ad4 (first)
        return [
            new Actions\ChunkUpload(),
        ];
    }
}
