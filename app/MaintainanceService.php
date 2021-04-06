<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaintainanceService extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'image'
    ];
    public function getImageAttribute($value)
    {
        return asset($value ? 'storage/' . $value : '/images/default_avatar.jpg');
    }

    protected $dates = ['deleted_at'];

    public function maintainance_providers()
    {
        return $this->hasMany(MaintainanceProvider::class);
    }
}
