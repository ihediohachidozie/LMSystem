<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class department extends Model
{
    protected $guarded = [];

    public function Users()
    {
        return $this->hasMany(User::class);
        
    }
}
