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
        $user = User::where('token', $request->input('token'))->first();
        $question = Question::find($request->input('question_id'));
        $data = $request->input();
        $data['user_id'] = $user->id;
        $data['level'] = $question->level;

        // TODO コードテスト
        $data['check_list'] = [
            ['flag' => true],
            ['flag' => false],
            ['flag' => false],
            ['flag' => true],
            ['flag' => true],
            ['flag' => false],
            ['flag' => true],
        ];
        return Result::calculate($data);;
    }

    public function execute(Request $request)
    {
        // TODO コードのテスト
        return [
            ['flag' => true],
            ['flag' => false],
            ['flag' => false],
            ['flag' => true],
            ['flag' => true],
            ['flag' => false],
            ['flag' => true],
        ];
    }
}
