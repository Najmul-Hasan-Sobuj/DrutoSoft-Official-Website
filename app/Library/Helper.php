<?php

use Intervention\Image\Facades\Image;

/**
 * this imageUpload function is globally upload any images
 * 
 */
class Helper{
    public static function imageUpload($mainFile)
    {
        $fileExtention = $mainFile->extension();

            $validExtentions = array('jpeg', 'jpg', 'png');
            $path = public_path('uploads/');
            $currentTime = time();
            $fileName = $currentTime.'.'.$fileExtention;

            if (in_array($fileExtention, $validExtentions)) {
    
                $mainFile->move($path, $fileName);
                 //create instance
                 $img = Image::make($path.'/'.$fileName);
                 //resize image
                 $img->resize(80, null, function ($constraint) {
                     $constraint->aspectRatio();
                 });
                 $img->save($path.'/thumb/'.$fileName);
                
                 $output['status'] = 1;
                 $output['filaName'] = $fileName;
            } else {
                $output['status'] = 0;
            }
            return $output;
    }
}