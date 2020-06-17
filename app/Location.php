<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';

    protected $fillable = [
        'code', 'prefecture'
    ];

    protected $primaryKey = "id";

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
