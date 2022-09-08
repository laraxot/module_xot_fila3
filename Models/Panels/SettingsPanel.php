<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels;

<<<<<<< HEAD
// --- Services --
=======
//--- Services --
>>>>>>> 9472ad4 (first)

/**
 * Class SettingsPanel.
 */
<<<<<<< HEAD
class SettingsPanel extends XotBasePanel {
=======
class SettingsPanel extends XotBasePanel
{
>>>>>>> 9472ad4 (first)
    /**
     * The model the resource corresponds to.
     */
    public static string $model = 'Modules\Xot\Models\Settings';

    /**
     * The single value that should be used to represent the resource when being displayed.
     */
    public static string $title = 'title';

<<<<<<< HEAD
    /** @return object[] */
    public function fields(): array {
=======
    // @return object[]

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
                'name' => 'appname',
                'rules' => 'required',
                'comment' => null,
            ],
            (object) [
                'type' => 'String',
                'name' => 'description',
                'rules' => 'required',
                'comment' => null,
            ],
            (object) [
                'type' => 'Text',
                'name' => 'keywords',
                'comment' => 'not in Doctrine',
            ],
            (object) [
                'type' => 'Text',
                'name' => 'author',
                'comment' => 'not in Doctrine',
            ],
        ];
    }
}
