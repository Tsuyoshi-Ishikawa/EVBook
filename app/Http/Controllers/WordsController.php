<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Word;

class WordsController extends Controller
{
    public function create() {
        return view('Words.create');
    }

    public function store(Request $request) {
        $this->validate($request, Word::$rules);
        $currentUser = Auth::user();
        $word = new Word();
        $word->setValues($currentUser, $request);
        return redirect('/home');
    }

    public function edit(Word $word) {
        return view('Words.edit')->with('word', $word);
    }

    public function update(Request $request, Word $word) {
        $this->validate($request, Word::$rules);
        $currentUser = Auth::user();
        $word_ids = $currentUser->WordIds();
        $word->updateValues($word_ids, $request);
        return redirect('/home');
    } 

    public function destroy(Request $request) {
        $this->validate($request, Word::$id_rules);
        $currentUser = Auth::user();
        Word::deleteValue($request->id);
    }

    public function test() {
        $currentUser = Auth::user();
        $rand_word = $currentUser->getRandWord();
        if (is_null($rand_word)) {
            return redirect('/home');
        } 
        return view('Words.test')->with('rand_word', $rand_word);
    }

    public function index() {
        $currentUser = Auth::user();
        $words = $currentUser->getOtherWords();
        return view('Words.index')->with('words', $words);
    }

    public function like(Request $request) {
        $v_rule = [
            'word_id' => 'required|integer',
            'type' => ['required', 'string', 'regex:/^([a-zA-Z])*$/'],
        ];
        $this->validate($request, $v_rule);
        $currentUser = Auth::user();

        $favo_type = $request->type;
        $word_id = $request->word_id;
        $currentUser->switchFavo($favo_type, $word_id);
    }
}
