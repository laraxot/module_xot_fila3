<?php

declare(strict_types=1);

<<<<<<< HEAD
// namespace Intervention\Image\Templates;
=======
//namespace Intervention\Image\Templates;
>>>>>>> 9472ad4 (first)

namespace Modules\Xot\Filters\Images;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

<<<<<<< HEAD
class Large implements FilterInterface {
    public function applyFilter(Image $image) {
=======
class Large implements FilterInterface
{
    public function applyFilter(Image $image)
    {
>>>>>>> 9472ad4 (first)
        return $image->fit(480, 360);
    }
}
