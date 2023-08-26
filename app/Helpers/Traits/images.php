<?php

namespace App\Helpers\Traits;

use App\Models\File as ModelsFile;
use Illuminate\Support\Facades\File;


class images
{

    function images($request, $destinationPath, $model)
    {
        if ($request->file("image_data")) {

            $file = $request->file('image_data');
            File::isDirectory($destinationPath) or
            File::makeDirectory($destinationPath, 0755, true, true);
            $filename = $file->hashName();
            $file->move($destinationPath, $filename);

            $image = new ModelsFile(['file' => $destinationPath . $filename]);
            $model->image()->save($image);

        }
    }

}
