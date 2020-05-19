<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Word;
use App\Like;
use App\Helper\Helper;

class WordsController extends Controller
{
    public function create() {
        return view('Words.create');
    }

    public function store(Request $request) {
        $this->validate($request, Word::$rules);
        $currentUser = Auth::user();
        $word = new Word();
        $word->setProperty($currentUser, $request);
        return redirect()->action('UsersController@home',$currentUser);
    }

    public function edit(Word $word) {
        return view('Words.edit')->with('word', $word);
    }

    public function update(Request $request, Word $word) {
        $this->validate($request, Word::$rules);
        $currentUser = Auth::user();
        $word->setProperty($currentUser, $request);
        return redirect()->action('UsersController@home',$currentUser);
    } 

    public function destroy(Request $request) {
        $this->validate($request, Word::$id_rules);
        $currentUser = Auth::user();
        Word::deleteProperty($request->id);
    }

    public function test() {
        $currentUser = Auth::user();
        $User_words = $currentUser->words;
        if ($User_words->count()) {
            $likes = Like::where('user_id', $currentUser->id)->get();
            Word::addFavoWords($User_words, $likes, 'word_id');
            $rand_word = Helper::createRWord($User_words);
            return view('Words.test')->with('rand_word', $rand_word);
        }
        return redirect()->action('UsersController@home');
    }

    public function index() {
        $currentUser = Auth::user();
        $likes = Like::where('user_id', $currentUser->id)->get();
        $words = Word:: getNotFavoWords($likes, 'word_id');
        return view('Words.index')->with('words', $words);
    }

    public function like(Request $request) {
        $this->validate($request, Like::$rules);
        $currentUser = Auth::user();
        Helper::favoSwitch($currentUser, $request, 'type', 'id');
    }
}
