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
class Medium implements FilterInterface {
    public function applyFilter(Image $image) {
=======
class Medium implements FilterInterface
{
    public function applyFilter(Image $image)
    {
>>>>>>> 9472ad4 (first)
        return $image->fit(240, 180);
    }
}
