<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $primaryKey = 'review_id';

    public static $rules = array(
        'game_id' => 'required',
        'review_point' => 'required|integer|max:100|min:0',
        'review_title' => 'required',
        'review_content' => 'required'
    );

    public static $rules_update = array(
        'review_id' => 'required'
    );

    public function game()
    {
        return $this->belongsTo('App\Game', 'game_id');
    }

    public function profile()
    {
        return $this->belongsTo('App\Profile', 'user_id');
    }

    public function evaluations()
    {
        return $this->hasMany('App\Evaluation', 'review_id');
    }
}
