<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name', 'website', 'description', 'phone', 'address', 'type', 'lat', 'long'
    ];
}
