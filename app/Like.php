<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public static $rules = [
        'word_id' => 'required|integer',
        'type' => 'required|string'
    ];

    public function users() {
        return $this->hasMany('App\User');
    }

    public function words() {
        return $this->hasMany('App\Word');
    }

    public function scopeSearch($query, $user_id, $word_id) {
        return $query->where('user_id', $user_id)->where('word_id', $word_id)->first();
    }
}