<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'starte_date', 'end_date', 'monthly_rent', 'monthly_maintainance_rent', 'contract', 'status'];

    public function getContractAttribute($value)
    {
        return asset($value ? 'storage/' . $value : '');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
