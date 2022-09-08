<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels;

use Illuminate\Http\Request;

<<<<<<< HEAD
// --- Services --

class FeedPanel extends XotBasePanel {
=======
//--- Services --

class FeedPanel extends XotBasePanel
{
>>>>>>> 9472ad4 (first)
    /**
     * The model the resource corresponds to.
     */
    public static string $model = 'Modules\Xot\Models\Feed';

    /**
     * The single value that should be used to represent the resource when being displayed.
     */
    public static string $title = 'title';

    /**
     * Get the fields displayed by the resource.
        'value'=>'..',
     */
<<<<<<< HEAD
    public function fields(): array {
        return [
            (object) [
=======
    public function fields(): array
    {
        return [
            0 => (object) [
>>>>>>> 9472ad4 (first)
                'type' => 'Text',
                'name' => 'id',
                'comment' => 'not in Doctrine',
            ],
        ];
    }

    /**
     * Get the tabs available.
     */
<<<<<<< HEAD
    public function tabs(): array {
=======
    public function tabs(): array
    {
>>>>>>> 9472ad4 (first)
        $tabs_name = [];

        return $tabs_name;
    }

    /**
     * Get the cards available for the request.
     */
<<<<<<< HEAD
    public function cards(Request $request): array {
=======
    public function cards(Request $request): array
    {
>>>>>>> 9472ad4 (first)
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     */
<<<<<<< HEAD
    public function filters(Request $request = null): array {
=======
    public function filters(Request $request = null): array
    {
>>>>>>> 9472ad4 (first)
        return [];
    }

    /**
     * Get the lenses available for the resource.
     */
<<<<<<< HEAD
    public function lenses(Request $request): array {
=======
    public function lenses(Request $request): array
    {
>>>>>>> 9472ad4 (first)
        return [];
    }

    /**
     * Get the actions available for the resource.
     */
<<<<<<< HEAD
    public function actions(): array {
        return [];
    }
}
=======
    public function actions(): array
    {
        return [];
    }
}
>>>>>>> 9472ad4 (first)
