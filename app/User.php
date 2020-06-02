<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Word;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function words() {
        return $this->hasMany('App\Word');
    }

    public function favo_words() {
        return $this->belongsToMany('App\Word');
    }

    public function getAllWords() {
        $words = $this->words;
        foreach ($this->favo_words as $favo_word) {
            $words[] = $favo_word;
        }
        return $words;
    }

    public function getRandWord() {
        $test_words = $this->words;
        $favo_words = $this->favo_words;
        if ($test_words->count()) {
            foreach ($favo_words as $favo_word) {
                $test_words[] = $favo_word;
            }
            $word_count = $test_words->count() + $favo_words->count();
            $rand = rand(0, $word_count-1);
            return $test_words[$rand];
        } else {
            return null;
        }
    }

    public function getOtherWords() {
        $word_ids = [];
        foreach ($this->words as $word) {
            $word_ids[] = $word->id;
        }
        foreach ($this->favo_words as $favo_word) {
            $word_ids[] = $favo_word->id;
        }
        return Word::whereNotIn('id', $word_ids)->orderBy('id', 'desc')->get();
    }

    public function switchFavo(string $favo_type, int $word_id) {
        if ($favo_type === 'add') {
            $this->favo_words()->attach($word_id);
        } elseif ($favo_type === 'remove') {
            $this->favo_words()->detach($word_id);
        } else {
            header("Content-Type: application/json; charset=UTF-8");
            $data = [
                'failedMsg' => 'お気に入り登録or解除に失敗しました'
            ];
            echo json_encode($data);
            exit;
        }
    }

    public function WordIds() {
        $user_words = $this->words;
        $U_Words_ids = [];
        foreach ($user_words as $user_word) {
            $U_Words_ids[] = $user_word->id;
        }
        return $U_Words_ids;
    }

    public static function searchUser($keyWord) {
        $users = DB::table('users')->where('name', 'like', '%' . htmlspecialchars($keyWord, ENT_QUOTES, "UTF-8") . '%')->get();
            if (count($users) !== 0) {
                header("Content-Type: application/json; charset=UTF-8");
                $data = [
                    'users' => $users
                ];
                echo json_encode($data);
                exit;
            }
    }

    public static function selectUser(int $id) {
        $user = self::findOrFail($id);
        if (Auth::user()->id === $user->id) {
            return false;
        } else {
            return $user;
        }
    }
}
