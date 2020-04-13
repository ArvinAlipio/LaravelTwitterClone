<?php

namespace App;

trait Followable
{
    /**
     * *Follow a user.
     */
    public function follow(User $user)
    {
        return $this->follows()->save($user);
    }

    /**
     * *Unfollow a user.
     */
    public function unfollow(User $user)
    {
        return $this->follows()->detach($user);
    }

    /**
     * *Toggle user follow
     */
    public function toggleFollow(User $user)
    {
        $this->following($user) ?  $this->unfollow($user) :  $this->follow($user);

        // *Could also be implemented using the toggle function
        // $this->follows()->toggle($user);
    }

    /**
     * *Retrieves list of users that the logged-in user follows
     */
    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id');
    }

    /**
     * *Check if current user is following
     */
    public function following(User $user)
    {
        return $this->follows()->where('following_user_id', $user->id)->exists();
    }
}