<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
