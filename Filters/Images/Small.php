<?php

<<<<<<< HEAD
// namespace Intervention\Image\Templates;
=======
//namespace Intervention\Image\Templates;
>>>>>>> 9472ad4 (first)

declare(strict_types=1);

namespace Modules\Xot\Filters\Images;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

<<<<<<< HEAD
class Small implements FilterInterface {
    /**
     * @return \Intervention\Image\Image
     */
    public function applyFilter(Image $image) {
        // return $image->fit(120, 90);
=======
class Small implements FilterInterface
{
    /**
     * @return \Intervention\Image\Image
     */
    public function applyFilter(Image $image)
    {
        //return $image->fit(120, 90);
>>>>>>> 9472ad4 (first)
        $width = $height = 120;

        return $image->fit($width, $height);

        /*
        $image->resize($width, $height, function ($constraint): void {
            $constraint->aspectRatio();
        });

        return $image->resizeCanvas($width, $height, 'center', false, '#fff');
        */
    }
}
