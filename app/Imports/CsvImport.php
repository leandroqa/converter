<?php

namespace App\Imports;

use App\Import;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use App\Services\FormatFile;
use Illuminate\Validation\Rule;



class CsvImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Import([            
            'name' => FormatFile::formatName($row[0]),
            'address' => FormatFile::formatAddress($row[1]),
            'stars' => FormatFile::formatStars($row[2]),
            'contact' => FormatFile::formatContact($row[3]),
            'phone' => FormatFile::formatPhone($row[4]),
            'url' => FormatFile::formatUrl($row[5]),            
        ]);        
    }

}
