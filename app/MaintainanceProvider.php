<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaintainanceProvider extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'website', 'description', 'phone', 'address', 'maintainance_service_id', 'lat', 'long'];
    public function maintainance_service()
    {
        return $this->belongsTo(MaintainanceService::class);
    }
}
