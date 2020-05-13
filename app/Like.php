<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public static $rules = [
        'word_id' => 'required|integer',
        'type' => 'required|string'
    ];

    public function scopeSearch($query, $user_id, $word_id) {
        return $query->where('user_id', $user_id)->where('word_id', $word_id)->first();
    }
}