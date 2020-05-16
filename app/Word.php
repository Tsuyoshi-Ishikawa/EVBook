<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Word extends Model
{
    protected $guarded = array('id');

    public function user() {
        return $this->belongsTo('App\User');
    }

    public static $rules = [
        'English' => 'required|string|alpha',
        'Japanese' => 'required|string',
    ];

    public static $id_rules = [
        'word_id' => 'required|integer',
    ];

    public function setProperty(User $user, $request) {
        $this->English = $request->English;
        $this->Japanese = $request->Japanese;
        $user->words()->save($this);
    }

    public static function deleteProperty(int $id) {
        $word = self::findOrFail($id);
        $word->delete();
    }

    public static function addFavoWords($User_words, $likes, string $word_id) {
        foreach ($likes as $like) {
            $liked_id = $like->$word_id;
            // $User_words[] = self::where('id', $liked_id)->first();
            $User_words[] = self::findOrFail($liked_id);
        }
    }
}
