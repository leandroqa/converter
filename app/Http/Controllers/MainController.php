<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UploadController;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\MainRequest;
use App\Import;
use App\Services\Convert;
use App\Imports\CsvImport;


class MainController extends Controller
{
    private $upload;
    private $import; 
       

    public function __construct(UploadController $upload, Import $import)
    {
        $this->upload = $upload;
        $this->import = $import;
    }
    /**
     * Display main page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Store the csv file and convert it to a type selected.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MainRequest $request)
    {   
        $validated = $request->validated();
        try{
            $uploadedFile = $this->upload->uploadFile($request->file);            
            if($uploadedFile)
            {   
                $this->import->truncate(); //clear temp table           
                Excel::import(new CsvImport, $uploadedFile);                
            }
        }
        catch(\Exception $e)
        {   
            return \Redirect::back()->withError($e->getMessage());
        }        
        $this->import->clearTable()->delete(); 
        //$this->upload->destroyFile($uploadedFile);    
        $convertedFile = Convert::convertTo($request->formats,$uploadedFile);        
        return \Redirect::back()->withSuccess( 'Your file has been imported successfuly! ' .$convertedFile);        
    }

}
