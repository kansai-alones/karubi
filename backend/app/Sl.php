<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sl extends Model
{
    protected $fillable = [
        'sequence_id', 'enquete_id', 'choice_id'
    ];

    public function sequence()
    {
        return $this->belongsTo('App\Sequence');
    }
}
