<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;


class ProfilesController extends Controller
{
    /**
     * *Displays user profile
     */
    public function show(User $user)
    {
        return view('profiles.show', compact('user'));
    }

    /**
     * *Displays the form to edit user profile
     */
    public function edit(User $user)
    {
        // abort_if($user->isNot(current_user()), 404);

        //*Improved with policy 
        $this->authorize('edit', $user);
        //*Improved further, moved in routes file
        //? Tried it and it is not working, reverted back to the authorize()

        return view('profiles.edit', compact('user'));
    }

    /**
     * * Updates the user profile
     */
    public function update(User $user)
    {

        $this->authorize('edit', $user);

        $attributes = request()->validate([
           'username' => ['string', 'required', 'max:255', 'alpha_dash'], //, Rule::unique('users')->ignore($user)
           'name'     => ['string', 'required', 'max:255'],
           'avatar'   => ['file'],
           'email'    => ['string', 'required', 'email', 'max:255'], //Rule::unique('users')->ignore($user)
           'password' => ['string', 'required', 'min:8', 'max:255', 'confirmed'],
        ]);

        if(request('avatar'))
        {
            $attributes['avatar'] = request('avatar')->store('avatars');
        }

        $user->update($attributes);

        return redirect($user->path());
    }

}
