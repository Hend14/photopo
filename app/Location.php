<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'code', 'prefecture'
    ];

    protected $primaryKey = "id";

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
