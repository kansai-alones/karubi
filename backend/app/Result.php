<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'question_id', 'user_id', 'score', 'level'
    ];

    public function question()
    {
        return $this->belongsTo('App\Question');
    }

    /**
     * create new result after calculate
     * @param  array  $data [description]
     * @return Result       [description]
     */
    public static function calculate(array $data) : Result
    {
        $result = Result::make($data);
        $size  = Question::find($data['question_id'])->checks->count();
        $count = 0;
        foreach ($data['check_list'] as $check) {
            if ($check['flag']) {
                $count = $count + 1;
            }
        }
        $score = (100.0 / $size) * $count;
        $result->score = (100.0 / $size) * $count;
        $result->save();
        return $result;
    }
}
