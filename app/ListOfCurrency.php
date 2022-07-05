<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListOfCurrency extends BaseModel
{
    use HasFactory;
    protected $fillable = ['name','code'];
}
