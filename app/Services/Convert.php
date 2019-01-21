<?php

namespace App\Services;

use App\Import as dbImport;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class Convert implements \App\Interfaces\ConvertInterface
{
   
    public static function convertTo($type,$file)
    {
        switch ($type){
            case  'json' :
                return self::convertToJson($file);
                break;
            case 'html' :
                return self::convertToHtml($file);
                break;
        }        
    }

    private static function convertToJson($file)
    {   
        try{
            $result = dbImport::select('name','address','stars','contact','phone','url')->get();        
            $json = $result->toJson();            
            $fileName = self::getFilename($file).".json";             
            Storage::disk('files')->put($fileName, $json);        
        }     
        catch(\Exception $e)
        {
            return "ERROR to generate Json file.";
        }        
        return "A Json file has been created: <a href='files/".$fileName."' target='mew'>download</a>";
        
    }

    private static function convertToHtml($file)
    {        
        $htmlHeader = "<!doctype html>
        <html lang='en'>
          <head>
            <!-- Required meta tags -->
            <meta charset='utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
        
            <!-- Bootstrap CSS -->
            <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css' integrity='sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS' crossorigin='anonymous'>
            <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>
        
            <title>The Converter</title>
          </head>
          <body>";
        
        $htmlBody = "";
        
        $htmlFooter = "<script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js' integrity='sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut' crossorigin='anonymous'></script>
            <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js' integrity='sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k' crossorigin='anonymous'></script>    
            <script src='http://localhost:8000/js/convert.js'></script>    
        </body>
        </html>";

        $result = dbImport::select('name','address','stars','contact','phone','url')->orderBy('name','asc')->get();
        $amount = "";
        $stars = function($amount)
            {
                $star = "<i class='fas fa-star'></i>";
                $htmlStars = "";
                if($amount > 0)
                {
                    for($i =0; $i < $amount; $i++)
                    {
                        $htmlStars .= $star;
                    }            
                }
                return  $htmlStars;
            };            
        foreach($result as $tags)
        {
            $htmlBody .= "<div class='card w-100 p-3'>        
                <div class='card-body'>
                    <h5 class='card-title'>".$tags->name."&nbsp;";
            
            $htmlBody .= $stars($tags->stars);
            $htmlBody .=" </h5>
                    <p class='card-text'><strong>Address: </strong>".$tags->address."</p>
                    <p class='card-text'><strong>Contact: </strong>".$tags->contact." <strong>Phone: </strong>".$tags->phone."</p>
                    <a href='".$tags->url."' class='btn btn-primary' target='new'>visit website</a>
                </div>
            </div>";    
        }

        try{
            if(trim($htmlBody) !== '')
            {
                $fullHtml = $htmlHeader.$htmlBody.$htmlFooter;                
                $fileName = self::getFilename($file).".html";
                Storage::disk('files')->put($fileName, $fullHtml); 
            }
            else {                                
                throw new \Exception("Error on generate html content."); 
            }                                   
        }             
        catch(\Exception $e)
        {
            return "ERROR to generate HTML file.";
        }        
        return "An HTML file has been created: <a href='files/".$fileName."' target='mew'>visit</a>";
        
    }
    
    public static function getFilename($file)
    {        
        try{
            $filename = explode(".",$file);            
            return $filename[0];
        }
        catch(\Exception $e)
        {         
            return md5(time() . '-converted');
        }
    }


}