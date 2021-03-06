<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    
    public function microposts() {
        return $this->hasMany(Micropost::class);
    }
    
    public function followings() {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }
    
    public function followers() {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
    
    public function follow($userId) {
        $exist = $this->is_following($userId);
        $its_me = $this->id == $userId;
        
        if ($exist || $its_me) {
            return false;
        } else {
            $this->followings()->attach($userId);
            return true;
        }
    }
    
    public function unfollow($userId) {
        $exist = $this->is_following($userId);
        $its_me = $this->id == $userId;
        
        if ($exist && !$its_me) {
            $this->followings()->detach($userId);
            return true;
        } else {
            return false;
        }
    }
    
    public function is_following($userId) {
        return $this->followings()->where('follow_id', $userId)->exists();
    }
    
    public function feed_microposts() {
        $following_id = $this->followings()->lists('users.id')->toArray();
        $following_id[] = $this->id;
        return Micropost::wherein('user_id', $following_id);
    }
    
    public function liking() {
        return $this->belongsToMany(Micropost::class, 'favorite', 'user_id', 'micropost_id')->withTimestamps();
    }
    
    public function like($micropostId) {
        $exist = $this->like_item($micropostId);
        if ($exist) {
            return false;
        } else {
            $this->liking()->attach($micropostId);
        }
    }
    
    public function unlike($micropostId) {
        $exist = $this->like_item($micropostId);
        if ($exist) {
            $this->liking()->detach($micropostId);
        } else {
            return false;
        }
    }
    
    public function like_item($micropostId) {
        return $this->liking()->where('micropost_id', $micropostId)->exists();
    }
    
}
