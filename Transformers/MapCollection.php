<<<<<<< HEAD
<?php

declare(strict_types=1);

namespace Modules\Xot\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class MapCollection.
 */
class MapCollection extends ResourceCollection {
    /**
     * @var string
     */
    public $collects = MapResource::class;

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request) {
        return [
            'type' => 'FeatureCollection',
            'features' => $this->collection,
            /*'links' => [
                'self' => 'link-value',
            ],*/
        ];
    }
}
=======
<?php

declare(strict_types=1);

namespace Modules\Xot\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class MapCollection.
 */
class MapCollection extends ResourceCollection {
    /**
     * @var string
     */
    public $collects = MapResource::class;

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request) {
        return [
            'type' => 'FeatureCollection',
            'features' => $this->collection,
            /*'links' => [
                'self' => 'link-value',
            ],*/
        ];
    }
}
>>>>>>> 3c97c308c85924a62f31c89c71edfe23450749f0
