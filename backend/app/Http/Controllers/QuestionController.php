<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Question;
use App\Result;

class QuestionController extends Controller
{
    /**
     * コードの評価を行い, データベースに保存する. 結果を返す.
     * @param  Request $request
     * @return Result コードの評価
     */
    public function create(Request $request) : Result
    {
        $user = User::demo();
        // $user = User::where('token', $request->input('token'))->first();
        $question = Question::find($request->input('question_id'));
        $data = $request->input();
        $data['user_id'] = $user->id;
        $data['level'] = $question->level;

        $ifile    = storage_path('code/ToDo.php');
        $testfile = base_path('tests/Unit/ToDo.php');
        $filename = base_path('result.json');
        chmod($ifile, 777);
        copy($ifile, $testfile);
        exec('cd /var/www/app && ./vendor/bin/phpunit');
        
        $data['check_list'] = json_decode(file_get_contents($filename));

        return Result::calculate($data);;
    }

    public function get()
    {
        return Question::find(1);
    }
}
