<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels;

<<<<<<< HEAD
// --- Services --
=======
//--- Services --
>>>>>>> 9472ad4 (first)

/**
 * Class WidgetPanel.
 */
<<<<<<< HEAD
class WidgetPanel extends XotBasePanel {
=======
class WidgetPanel extends XotBasePanel
{
>>>>>>> 9472ad4 (first)
    /**
     * The model the resource corresponds to.
     */
    public static string $model = 'Modules\Xot\Models\Widget';

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
                'name' => 'layout_position',
                'comment' => null,
            ],
            (object) [
                'type' => 'String',
                'name' => 'post_type',
                'comment' => null,
            ],
            (object) [
                'type' => 'String',
                'name' => 'post_id',
                'comment' => null,
            ],
            (object) [
                'type' => 'String',
                'name' => 'title',
                'comment' => null,
            ],
            (object) [
                'type' => 'String',
                'name' => 'blade',
                'comment' => null,
            ],
            (object) [
                'type' => 'Image',
                'name' => 'image_src',
                'comment' => null,
            ],
            (object) [
                'type' => 'Integer',
                'name' => 'pos',
                'comment' => null,
            ],
            (object) [
                'type' => 'String',
                'name' => 'model',
                'comment' => null,
            ],
            (object) [
                'type' => 'String',
                'name' => 'limit',
                'comment' => null,
            ],
            (object) [
                'type' => 'String',
                'name' => 'order_by',
                'comment' => null,
            ],
        ];
    }
}
