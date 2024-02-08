<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use File;
use ZipArchive;
  
class ZipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $zip = new ZipArchive;
    
        $fileName = 'asd.txt';
     
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE)
        {
            $files = File::files(public_path('test'));
     
            foreach ($files as $key => $value)
            {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }
               
            $zip->close();
        }
      
        return response()->download(public_path($fileName));
    }
}