<?php 

namespace App\Helpers;

class UploadHelper {

    static function  upload($file, $fileName, $targetLocation) {
            if (!is_null($file)) {
                $extension = $file->getClientOriginalExtension();
                $fileName .= '.'.$extension;
                $file->move($targetLocation, $fileName);
                return $fileName;
            }
            return null;
    }

}