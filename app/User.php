<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return string
     */
    public function avatar()
    {
        return 'https://www.gravatar.com/avatar/'.md5($this->email).'?d=mp';
    }

    /**
     * @param  Tweet  $tweet
     * @return mixed
     */
    public function hasLiked(Tweet $tweet)
    {
        return $this->likes->contains('tweet_id', $tweet->id);
    }

    /**
     * @return HasMany
     */
    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    /**
     * @return BelongsToMany
     */
    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'following_id');
    }

    /**
     * @return BelongsToMany
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'following_id', 'user_id');
    }

    /**
     * @return HasManyThrough
     */
    public function tweetsFromFollowing()
    {
        return $this->hasManyThrough(Tweet::class, Follower::class, 'user_id', 'user_id', 'id', 'following_id');
    }

    /**
     * @return HasMany
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
