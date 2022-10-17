<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels;

use Modules\Job\Models\Job;
use Illuminate\Http\Request;
// --- Services --

use Illuminate\Database\Eloquent\Model;
use Modules\Xot\Contracts\RowsContract;

class JobPanel extends XotBasePanel {
    /**
     * The model the resource corresponds to.
     */
    public static string $model = Job::class;
    public Job $row;

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
             (object) [
                'type' => 'Id',
                'name' => 'id',
                'comment' => null,
            ],
             (object) [
                'type' => 'String',
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
                'type' => 'Boolean',
                'name' => 'attempts',
                'rules' => 'required',
                'comment' => null,
            ],
             (object) [
                'type' => 'Integer',
                'name' => 'reserved_at',
                'comment' => null,
            ],
             (object) [
                'type' => 'Integer',
                'name' => 'available_at',
                'rules' => 'required',
                'comment' => null,
            ],
             (object) [
                'type' => 'Integer',
                'name' => 'created_at',
                'rules' => 'required',
                'comment' => null,
            ],
        ];
    }

    /**
     * Get the tabs available.
     */
    public function tabs(): array {
        $tabs_name = [];

        return $tabs_name;
    }

    /**
     * Get the cards available for the request.
     */
    public function cards(Request $request): array {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function filters(Request $request = null): array {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     */
    public function lenses(Request $request): array {
        return [];
    }

    /**
     * Get the actions available for the resource.
     */
    public function actions(): array {
        return [];
    }
}