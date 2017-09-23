<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sequence extends Model
{
    protected $fillable = [
        'user_id', 'token'
    ];

    public function sls()
    {
        return $this->hasMany('App\Sl');
    }
}
