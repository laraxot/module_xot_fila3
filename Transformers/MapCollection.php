<?php

declare(strict_types=1);

namespace Modules\Xot\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class MapCollection.
 */
<<<<<<< HEAD
class MapCollection extends ResourceCollection {
=======
class MapCollection extends ResourceCollection
{
>>>>>>> 9472ad4 (first)
    /**
     * @var string
     */
    public $collects = MapResource::class;

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
<<<<<<< HEAD
    public function toArray($request) {
=======
    public function toArray($request)
    {
>>>>>>> 9472ad4 (first)
        return [
            'type' => 'FeatureCollection',
            'features' => $this->collection,
            /*'links' => [
                'self' => 'link-value',
            ],*/
        ];
    }
}
