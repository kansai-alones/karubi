<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Question;
use App\Check;
use App\Result;

class ResultController extends Controller
{
    public function getScore(Request $request)
    {
        $id = $request->input('result_id');
        $result = DB::table('results')
            ->select('score', 'level')
            ->where('id', $request->input('result_id'))
            ->get()
            ->first();
        return [
            'score' => $result->score,
            'level' => $result->level,
        ];
    }

    public function getGraph(Request $request)
    {
        $user = User::where('token', $request->input('token'))->first();
        $temp = DB::table('results')
            ->select('score', 'level')
            ->where('id', $request->input('result_id'))
            ->get()
            ->first();
        $result = DB::table('results')
            ->select(DB::raw('score, count(*) as count'))
            ->join('users', 'results.user_id', 'users.id')
            ->where('level', $temp->level)
            ->where('users.type_id', $user->type_id)
            ->where('users.years', $user->years)
            ->groupBy('score')
            ->get();
        $temp = $result->toArray();
        $result = [];
        for ($i = 0; $i <= 100; $i++) {
            $result[$i] = ['score' => $i, 'count' => 0];
        }
        foreach ($temp as $key => $value) {
            $result[(int)($value->score)] = $value;
        }
        return $result;
    }

    /**
     * ユーザの特性と同じ人達がどのレベルに取り組んでいるのかを取得する
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getList(Request $request)
    {
        $user = User::where('token', $request->input('token'))->first();
        $result = DB::table('results')
            ->select(DB::raw('level, count(*) as count'))
            ->join('users', 'results.user_id', 'users.id')
            ->where('users.type_id', $user->type_id)
            ->where('users.years', $user->years)
            ->groupBy('level')
            ->get();
        $temp = $result->toArray();
        $result = [];
        for ($i = 0; $i < 5; $i++) {
            $result[$i] = ['level' => $i+1, 'count' => 0];
        }
        foreach ($temp as $key => $value) {
            $result[(int)($value->level) - 1] = $value;
        }
        return $result;
    }

    public function execute(Request $request)
    {
        $question = Question::find($request->input('question_id'));
        $count    = $question->checks->count();
        $result   = [];
        for ($i = 0; $i < $count; $i++) {
            $result[$i] = true;
        }
        return $result;
    }
}
