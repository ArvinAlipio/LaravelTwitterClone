<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class FollowsController extends Controller
{
    /**
     * *Functionality to have the logged-in user to the given user
     */
    public function store(User $user)
    {
      
        auth()->user()->toggleFollow($user);

        return back();
    }
}
