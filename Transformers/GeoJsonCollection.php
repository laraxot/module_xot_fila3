<?php

declare(strict_types=1);

namespace Modules\Xot\Transformers;

/*
*  GEOJSON e' uno standard
* https://it.wikipedia.org/wiki/GeoJSON
**/

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class GeoJsonCollection.
 */
<<<<<<< HEAD
class GeoJsonCollection extends ResourceCollection {
=======
class GeoJsonCollection extends ResourceCollection
{
>>>>>>> 9472ad4 (first)
    /**
     * @var string
     */
    public $collects = GeoJsonResource::class;

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    // ErrorException (Declaration of Modules\Xot\Transformers\GeoJsonResource::toArray(Illuminate\Http\Request
    // $request) should be compatible with Illuminate\Http\Resources\Json\JsonResource::toArray($request)) thrown
    // while looking for class Modules\Xot\Transformers\GeoJsonResource.
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
