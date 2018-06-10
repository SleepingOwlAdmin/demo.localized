<?php

namespace App\Services\Image\Templates;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Thumb implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(300);
    }
}