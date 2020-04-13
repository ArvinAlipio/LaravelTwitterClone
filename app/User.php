<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use Notifiable, Followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name', 'avatar', 'email', 'password',
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
     * *Retrieves the avatar (display image) of the logged-in user
     * TODO: Improvement could be display uploaded user avatar
     * 
     * *UPDATE: Improvement has been applied.
     */
    public function getAvatarAttribute($value)
    {
        // return "https://i.pravatar.cc/200?u=" . $this->email;
        // return asset($value);
        return asset( $value ? 'storage/' . $value : "https://i.pravatar.cc/200?u=" . $this->email);
    }

    /**
     * *Bcrypts the password on user update 
     */
    public function setPasswordAttribute($value) 
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * * Retrieves tweets of the logged-in user
     * ? Needs improvement, what if I am following this user.
     * TODO: After applying the following system, display tweets of people you follow.
     * 
     * *UPDATE: Improvement has been applied.
     */
    public function timeline()
    {
        // return Tweet::where('user_id', $this->id)->latest()->get();
        $friends = $this->follows()->pluck('id');

        // ? Tried the one with no parenthesis, same results when plucked. But above returns belongsToMany, while
        // ? the one below returns Collection when the pluck is removed. The one above is more performant.
        // * $ids2 = $this->follows->pluck('id');
        // dd($ids, $ids2);
        // $ids->push($this->id);

        return Tweet::whereIn('user_id', $friends)
                    ->orWhere('user_id', $this->id)
                    ->latest()->get();
    }

    /**
     * *Returns the user's tweets.
     */
    public function tweets()
    {
        return $this->hasMany(Tweet::class)->latest();
    }

    /**
     * *Use this column instead of id for route model binding
     * *Could be placed directly in the routes file: {user:name}
     */
    // public function getRouteKeyName() 
    // {
    //     return 'name';
    // }

    /**
     * *Returns the path 
     * *Fixed in latest Laravel version
     * TODO: Could be refactored to be more simple
     */
    public function path($append = "")
    {
        $path = route("profile", $this->username);

        return $append ? "{$path}/{$append}" : $path;
    }

}
