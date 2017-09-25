<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'question_id', 'title', 'description', 'level'
    ];

    public function checks()
    {
        return $this->hasMany('App\Check');
    }

    public function results()
    {
        return $this->hasMany('App\Result');
    }
}
