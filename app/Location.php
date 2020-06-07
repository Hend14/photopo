<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'code', 'prefecture'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
