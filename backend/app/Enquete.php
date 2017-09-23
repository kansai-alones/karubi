<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enquete extends Model
{
    protected $fillable = [
        'title', 'level'
    ];

    public function choices()
    {
        return $this->hasMany('App\Choice');
    }
}
