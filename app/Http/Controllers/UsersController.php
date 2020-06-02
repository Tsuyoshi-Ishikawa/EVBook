<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Word;
use App\User;

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
        $words = $currentUser->getAllWords();
        return view('Users.home')->with([
            'currentUser' => $currentUser,
            'words' => $words,
        ]);
    }

    public function search() {
        return view('Users.search');
    }

    public function searchUser(Request $request) {
        if ($keyWord = $request->search_word) {
            User::searchUser($keyWord);
        }
    }

    public function show(int $id) {
        $user = User::selectUser($id);
        if ($user) {
            $words = $user->getAllWords();
            return view('Users.show')->with([
                'user' => $user,
                'words' => $words,
            ]);
        }
        return view('Users.search');
    }
}
