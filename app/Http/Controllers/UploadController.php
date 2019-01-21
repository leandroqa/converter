<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class UploadController extends Controller
{
	public static function uploadFile(UploadedFile $file)
	{		
		try {
			$extension = $file->getClientOriginalExtension();
			$filename = md5(time() . $file->getClientOriginalName()) . "." . $extension; 
			$original_name = $file->getClientOriginalName(); 			
			$upload = $file->move(public_path()."/files", $filename); 			

            if (is_null($upload)) {
                throw new \Exception('Error to upload file.');
			}			
        } catch (\Exception $e) {
            throw new \Exception('Error to upload file.');
		}
		return $filename;
	}

	public static function destroyFile($file)
	{			
		try {
			$storage = Storage::disk('local');
			$source = storage_path()."/files/".$file;			
			if (file_exists($source))
			{	
				$storage->delete($file);
			}
        } catch (\Exception $e) {
            throw new \Exception('Unexpected error occurred while deleting uploaded file.');
		}
		return true;
	}
}
