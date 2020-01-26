<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $primaryKey = 'user_id';

    protected $guarded = ['user_id'];

    public static $rules = array(
        'user_id' => 'required',
        'user_name' => 'required',
        'age' => 'required',
        'gender' => 'required',
        'favorite_genre' => 'required',
        'introduction' => 'required'
    );
}
