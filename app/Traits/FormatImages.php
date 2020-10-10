<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * A trait used to format given images
 */
trait FormatImages
{
    /**
     * save the resized images into the public/images
     * @param array $request, the validated request array.
     * @return string $newName, the name of the created file.
     * @throws \Intervention\Image\Exception\InvalidArgumentException
     * @throws \Intervention\Image\Exception\NotSupportedException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Intervention\Image\Exception\NotWritableException
     */
    private function HandleImage(array $request)
    {
        if ($request['file']) {
            $file = $request['file'];

            $newName = $file->hashName();

            //Storage::makeDirectory is important because if you don't create a new directory intervention image doesn't have the permission to create a new directory if the specified path doesn't already exist.
            Storage::makeDirectory('/images/small/');
            //the name of the final file should be provided in the file path refer to exemples at "http://image.intervention.io/api/save" for more infos
            $path = 'storage/images/small/' . $newName;
            $resized = Image::make($file)->resize(50, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode();
            //public path give the full qualified name to the given path in our app
            $resized->save(public_path($path));

            Storage::makeDirectory('/images/big/');
            $path = 'storage/images/big/' . $newName;
            $resized = Image::make($file)->resize(150, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode();
            $resized->save(public_path($path));

            Storage::makeDirectory('/images/original/');
            $path = 'storage/images/original/' . $newName;
            $image = Image::make($file)->encode();
            $image->save(public_path($path));
        }

        return $newName;
    }
}
