<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Word;
use App\Like;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home() {
        $currentUser = Auth::user();
        $likes = Like::where('user_id', $currentUser->id)->get();
        // $User_words = array();
        $User_words = $currentUser->words;
        // foreach ($likes as $like) {
        //     $liked_id = $like->word_id;
        //     $User_words[] = Word::where('id', $liked_id)->first();
        // }

        Word::addFavoWords($User_words, $likes, 'word_id');
        return view('Users.home', compact('currentUser','User_words'));
    }
}
