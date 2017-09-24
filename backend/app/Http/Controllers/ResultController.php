<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;

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
        return $result;
    }
}
