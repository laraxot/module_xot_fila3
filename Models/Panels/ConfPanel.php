<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels;

<<<<<<< HEAD
// --- Services --
=======
//--- Services --
>>>>>>> 9472ad4 (first)

/**
 * Class ConfPanel.
 */
<<<<<<< HEAD
class ConfPanel extends XotBasePanel {
=======
class ConfPanel extends XotBasePanel
{
>>>>>>> 9472ad4 (first)
    /**
     * The model the resource corresponds to.
     */
    public static string $model = 'Modules\Xot\Models\Conf';

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
                'name' => 'name',
<<<<<<< HEAD
                // 'rules' => 'required',
=======
                //'rules' => 'required',
>>>>>>> 9472ad4 (first)
                'comment' => null,
            ],
        ];
    }
}
