<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Post;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'age', 'location_id', 'profile_img'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * softdeleteを有効にする
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function feed_posts()
    {
        $follow_user_ids = $this->followings()->pluck('users.id')->toArray();
        $follow_user_ids[] = $this->id;
        return Post::whereIn('user_id', $follow_user_ids);
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }

    public function follow($userId)
    {
        $exist = $this->is_following($userId);
        $its_me = $this->id == $userId;

        if ($exist || $its_me) {
            return false;
        } else {
            $this->followings()->attach($userId);
            return true;
        }
    }

    public function unfollow($userId)
    {
        $exist = $this->is_following($userId);
        $its_me = $this->id == $userId;

        if ($exist && !$its_me) {
            $this->followings()->detach($userId);
            return true;
        } else {
            return false;
        }
    }

    public function is_following($userId)
    {
        return $this->followings()->where('follow_id', $userId)->exists();
    }

    public function likes()
    {
        return $this->belongsToMany(Post::class,'likes','user_id','post_id')->withTimestamps();
    }

    public function like($userId)
    {
        $exist = $this->is_liking($userId);
        if ($exist) {
            return false;
        } else {
            $this->likes()->attach($userId);
            return true;
        }
    }

    public function unlike($userId)
    {
        $exist = $this->is_liking($userId);
        if ($exist) {
            $this->likes()->detach($userId);
            return true;
        } else {
            return false;
        }
    }

    public function is_liking($userId)
    {
        return $this->likes()->where('post_id', $userId)->exists();
    }
}
