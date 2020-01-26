<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $primaryKey = 'game_id';

    protected $dates = [
        'release_date',
        'created_at',
        'updated_at',
    ];

    public static $rules = array(
        'game_id' => 'required'
    );

    public static $rules_update = array(
        'game_title' => 'required',
        'release_date' => 'required|date',
        'maker_name' => 'required',
        'game_genre' => 'required',
        'game_summary' => 'required'
    );

    public static $rules_search = array(
        'game_keyword' => 'required'
    );

    public function reviews()
    {
        return $this->hasMany('App\Review', 'game_id');
    }
}
