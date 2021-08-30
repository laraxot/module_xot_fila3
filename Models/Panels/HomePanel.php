<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels;

//--- Services --

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
     * The columns that should be searched.
     */
    public static array $search = [];

    /**
     * The relationships that should be eager loaded on index queries.
     */
    public function with(): array {
        return ['widgets'];
    }

    public function search(): array {
        return [];
    }

    /**
     * on select the option id.
     *
     * @return mixed
     */
    public function optionId(object $row) {
        return $row->area_id;
    }

    /**
     * on select the option label.
     */
    public function optionLabel(object $row): string {
        return $row->area_define_name;
    }

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
     *
     * @return array
     */
    public function actions() {
        $cmd = (string) request()->input('cmd');

        return [
            new Actions\ArtisanAction($cmd),
            new Actions\TestAction(),
        ];
    }
}
