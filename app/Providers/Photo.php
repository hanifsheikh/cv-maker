<?php

namespace App\Providers;

use Intervention\Image\ImageManagerStatic as Image;

class Photo
{
    public static function getCVPhoto($height = 230, $width = 200)
    {
        // Make 5 times multiplied by image size in pdf
        $image_height = $height * 5;
        $image_width = $width * 5;
        Image::configure(['driver' => 'imagick']);
        $img = Image::make(getPhoto(auth()['photo']))->fit($image_width, $image_height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->crop($image_width, $image_height);
        return $img->encode('data-url');
    }
}
