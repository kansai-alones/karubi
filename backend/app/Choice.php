<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    protected $fillable = [
        'enquete_id', 'text'
    ];

    public function enquete()
    {
        return $this->belongsTo('App\Enquete');
    }
}
