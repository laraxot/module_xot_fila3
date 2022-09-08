<?php

declare(strict_types=1);

namespace Modules\Xot\Transformers;

<<<<<<< HEAD
// use Illuminate\Http\Resources\Json\ResourceCollection;
=======
//use Illuminate\Http\Resources\Json\ResourceCollection;
>>>>>>> 9472ad4 (first)
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class MapResource.
 */
<<<<<<< HEAD
class MapResource extends JsonResource {
=======
class MapResource extends JsonResource
{
>>>>>>> 9472ad4 (first)
    protected float $longitude;
    protected float $latitude;

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
            'type' => 'Feature',
            'properties' => [
                'p' => 'vending_machine',
                'id' => 'node/31605830',
            ],
            'geometry' => [
                'type' => 'Point',
                'coordinates' => [round($this->longitude, 7), round($this->latitude, 7)],
            ],
        ];
    }
}

/*
{"type":"Feature","properties":{"p":"vending_machine","id":"node/31605830"},"geometry":{"type":"Point","coordinates":[9.0796524,48.5308688]
*/
