<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Word;
use App\Like;

class WordsController extends Controller
{
    public function create() {
        return view('Words.create');
    }

    public function store(Request $request) {
        $this->validate($request, Word::$rules);
        $currentUser = Auth::user();
        // $currentUser = $this->currentUser();
        $word = new Word();
        $word->English = $request->English;
        $word->Japanese = $request->Japanese;
        $currentUser->words()->save($word);
        return redirect()->action('UsersController@home',$currentUser);
    }

    public function edit(Word $word) {
        return view('Words.edit')->with('word', $word);
    }

    public function update(Request $request, Word $word) {
        $this->validate($request, Word::$rules);
        $currentUser = Auth::user();
        // $currentUser = $this->currentUser();
        $word->English = $request->English;
        $word->Japanese = $request->Japanese;
        $word->save();
        return redirect()->action('UsersController@home',$currentUser);
    } 

    public function destroy(Request $request) {
        $this->validate($request, Word::$id_rules);
        $currentUser = Auth::user();
        // $currentUser = $this->currentUser();
        $word = Word::findOrFail($request->id);
        $word->delete();
    }

    public function test() {
        $currentUser = Auth::user();
        // $currentUser = $this->currentUser();
        $likes = Like::where('user_id', $currentUser->id)->get();
        $User_words = array();
        $User_words = $currentUser->words;
        foreach ($likes as $like) {
            $liked_id = $like->word_id;
            $User_words[] = Word::where('id', $liked_id)->first();
        }
        $word_count = $User_words->count();
        $rand = rand(0, $word_count-1);
        $rand_word = $User_words[$rand];

        // $word_count = $currentUser->words->count();
        // $rand = rand(0, $word_count-1);
        // $words = $currentUser->words;
        // $rand_word = $words[$rand];
        return view('Words.test')->with('rand_word', $rand_word);
    }

    public function index() {
        $currentUser = Auth::user();
        $likes = Like::where('user_id', $currentUser->id)->get();
        foreach ($likes as $like) {
            $likes_id[] = $like->word_id;
        }
        $words = Word::whereNotIn('id', $likes_id)->orderBy('id', 'desc')->get();
        return view('Words.index')->with('words', $words);
    }

    public function like(Request $request) {
        $this->validate($request, Like::$rules);
        $currentUser = Auth::user();
        // $currentUser = $this->currentUser();

        if ($request->type === 'remove') {
            $like = Like::Search($currentUser->id, $request->id);
            $like->delete();
        } elseif ($request->type === 'add') {
            $like = new Like();
            $like->user_id = $currentUser->id;
            $like->word_id = $request->id;
            $like->save();
        } else {
            throw new \Exception('お気に入り登録or解除に失敗しました');
        }
    }
}
