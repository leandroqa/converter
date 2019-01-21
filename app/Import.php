<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    protected $fillable = [
        'name','address','stars','contact','phone','url'
    ];

    /*Removes invalid rows from table*/
    public function clearTable()
    {
        return $this->where('name','0')
            ->orWhere('stars','<',0)
            ->orWhere('url','0');
    }

    
}
