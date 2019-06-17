<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id',
        'term',
        'quantity_results'
    ];
}
