<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Validation\Rule;

class Word extends Model
{
    protected $guarded = array('id');

    public static $rules = [
        'English' => ['required', 'string', 'regex:/^([a-zA-Z])*$/'],
        'Japanese' => 'required|string',
    ];

    public static function deleteRules(array $word_ids) {
        $v_rule = [
            'word_id' => [
                'required',
                'integer',
                Rule::in($word_ids),
            ],
        ];
        return $v_rule;
    } 

    public static function favoRules(array $word_ids) {
        $v_rule = [
            'word_id' => [
                'required',
                'integer',
                Rule::notIn($word_ids),
            ],
            'type' => ['required', 'string', 'regex:/^([a-zA-Z])*$/'],
        ];
        return $v_rule;
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function favo_users() {
        return $this->belongsToMany('App\User');
    }

    public function setValues(User $user, $request) {
        $this->English = $request->English;
        $this->Japanese = $request->Japanese;
        $user->words()->save($this);
    }

    public function updateValues($word_ids, $request) {
        $existJud = array_search($this->id, $word_ids);
        if (isset($existJud)) {
            $this->English = $request->English;
            $this->Japanese = $request->Japanese;
            $this->save();
        }
    }

    public static function deleteValue(int $id) {
        $word = self::findOrFail($id);
        $word->delete();
    }
}
