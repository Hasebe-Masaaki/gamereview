<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use \LaravelTreats\Model\Traits\HasCompositePrimaryKey;

    protected $primaryKey = ['review_id', 'user_id'];

    public static $rules = array(
        'review_id' => 'required'
    );

    protected $fillable = ['review_id', 'user_id'];

    public function review()
    {
        return $this->belongsTo('App\Review', 'review_id');
    }

    public function profile()
    {
        return $this->belongsTo('App\Profile', 'user_id');
    }
}
