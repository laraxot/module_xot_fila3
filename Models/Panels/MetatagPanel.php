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
 * Class MetatagPanel.
 */
<<<<<<< HEAD
class MetatagPanel extends XotBasePanel {
=======
class MetatagPanel extends XotBasePanel
{
>>>>>>> 9472ad4 (first)
    /**
     * The model the resource corresponds to.
     */
    public static string $model = 'Modules\Xot\Models\Metatag';

    /**
     * The single value that should be used to represent the resource when being displayed.
     */
    public static string $title = 'title';

    /**
     * @return object[]
     */
<<<<<<< HEAD
    public function fields(): array {
=======
    public function fields(): array
    {
>>>>>>> 9472ad4 (first)
        return [
            (object) [
                'type' => 'Id',
                'name' => 'id',
                'comment' => null,
            ],

            (object) [
                'type' => 'String',
                'name' => 'title',
                'comment' => null,
            ],

            (object) [
                'type' => 'Text',
                'name' => 'subtitle',
                'comment' => null,
            ],

            (object) [
                'type' => 'String',
                'name' => 'charset',
                'comment' => null,
            ],

            (object) [
                'type' => 'String',
                'name' => 'author',
                'comment' => null,
            ],

            (object) [
                'type' => 'Text',
                'name' => 'meta_description',
                'comment' => null,
            ],

            (object) [
                'type' => 'Text',
                'name' => 'meta_keywords',
                'comment' => null,
            ],

            (object) [
                'type' => 'Image',
                'name' => 'logo_src',
                'comment' => null,
            ],

            (object) [
                'type' => 'Text',
                'name' => 'logo_footer_src',
                'comment' => null,
            ],

            (object) [
                'type' => 'String',
                'name' => 'tennant_name',
                'comment' => null,
            ],
            (object) [
                'type' => 'String',
                'name' => 'sitename',
                'comment' => null,
            ],
        ];
    }

    /**
     * Get the actions available for the resource.
     */
<<<<<<< HEAD
    public function actions(Request $request = null): array {
        return [
            // new Actions\StoreFileMetatagAction(),
=======
    public function actions(Request $request = null): array
    {
        return [
            //new Actions\StoreFileMetatagAction(),
>>>>>>> 9472ad4 (first)
        ];
    }
}
