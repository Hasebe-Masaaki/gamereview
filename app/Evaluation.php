<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use \LaravelTreats\Model\Traits\HasCompositePrimaryKey;

    protected $primaryKey = ['review_id', 'user_id'];

    public static $rules = array(
        'review_id' => 'required',
        'review_eval' => 'required'
    );

    protected $fillable = ['review_id', 'user_id'];
}
