<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $guarded = [];

    public function getStatusAttribute($attribute)
    {
        return [
            0 => 'Pending',
            1 => 'Rejected',
            2 => 'Approved'
        ][$attribute];
    }  

    public function User()
    {
        return $this->belongsTo(User::class);
           
    }
}
