<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels;

use Illuminate\Http\Request;

<<<<<<< HEAD
// --- Services --
=======
//--- Services --
>>>>>>> 9472ad4 (first)

class FailedJobPanel extends XotBasePanel {
    /**
     * The model the resource corresponds to.
<<<<<<< HEAD
=======
     *
     * @var string
>>>>>>> 9472ad4 (first)
     */
    public static string $model = 'Modules\Xot\Models\FailedJob';

    /**
     * The single value that should be used to represent the resource when being displayed.
<<<<<<< HEAD
=======
     *
     * @var string
>>>>>>> 9472ad4 (first)
     */
    public static string $title = 'title';

    /**
     * Get the fields displayed by the resource.
<<<<<<< HEAD
=======
     *
     * @return array
        'col_size' => 6,
        'sortable' => 1,
        'rules' => 'required',
        'rules_messages' => ['it'=>['required'=>'Nome Obbligatorio']],
>>>>>>> 9472ad4 (first)
        'value'=>'..',
     */
    public function fields(): array {
        return [
            (object) [
                'type' => 'Id',
                'name' => 'id',
                'comment' => null,
            ],

            (object) [
                'type' => 'String',
                'name' => 'uuid',
                'rules' => 'required',
                'comment' => null,
            ],

            (object) [
                'type' => 'Text',
                'name' => 'connection',
                'rules' => 'required',
                'comment' => null,
            ],

            (object) [
                'type' => 'Text',
                'name' => 'queue',
                'rules' => 'required',
                'comment' => null,
            ],

            (object) [
                'type' => 'Text',
                'name' => 'payload',
                'rules' => 'required',
                'comment' => null,
            ],

            (object) [
                'type' => 'Text',
                'name' => 'exception',
                'rules' => 'required',
                'comment' => null,
            ],

            (object) [
                'type' => 'Datetime',
                'name' => 'failed_at',
                'rules' => 'required',
                'comment' => null,
            ],
        ];
    }

    /**
     * Get the tabs available.
<<<<<<< HEAD
=======
     *
     * @return array
>>>>>>> 9472ad4 (first)
     */
    public function tabs(): array {
        $tabs_name = [];

        return $tabs_name;
    }

    /**
     * Get the cards available for the request.
<<<<<<< HEAD
=======
     *
     * @return array
>>>>>>> 9472ad4 (first)
     */
    public function cards(Request $request): array {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
<<<<<<< HEAD
=======
     *
     * @return array
>>>>>>> 9472ad4 (first)
     */
    public function filters(Request $request = null): array {
        return [];
    }

    /**
     * Get the lenses available for the resource.
<<<<<<< HEAD
=======
     *
     * @return array
>>>>>>> 9472ad4 (first)
     */
    public function lenses(Request $request): array {
        return [];
    }

    /**
     * Get the actions available for the resource.
<<<<<<< HEAD
=======
     *
     * @return array
>>>>>>> 9472ad4 (first)
     */
    public function actions(): array {
        return [
            new Actions\ArtisanContainerAction('queue:flush'),
            new Actions\ShowFailedJobAction(),
        ];
    }
}
