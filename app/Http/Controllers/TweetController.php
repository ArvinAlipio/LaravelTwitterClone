<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tweet;

class TweetController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('tweets.index', [
            'tweets' => auth()->user()->timeline()
        ]);
    }

    /**
     * *Save tweet in database
     */
    public function store()
    {

        $attributes = request()->validate(['body' => 'required|max:255']);

        Tweet::create([
            'user_id' => auth()->user()->id,
            'body' => request('body'),
        ]);

        return redirect()->route('home');
    }
}
