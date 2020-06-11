<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    protected $fillable = [
        'content', 'post_img', 'user_id'
    ];

    protected $dates = ['deleted_at'];

    public function user()
        {
            return $this->belongsTo(User::class);
        }
}
