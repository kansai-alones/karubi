<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Sequence;
use App\Enquete;
use App\Sl;

class EnqueteController extends Controller
{
    public function getEnquete(Request $request)
    {
        $count = 0;
        $user = User::where('token', $request->token)->first();
        $st = $request->input('sequence_token');
        if (!isset($st)
            || !Sequence::where('user_id', $user->id)
                    ->where('token', $st)
                    ->exists()
        ) {
            $sequence = Sequence::create([
                'user_id'   => $user->id,
                'token'     => str_random(40)
            ]);
            $enquete = Enquete::inRandomOrder()->with('choices')->first();
            Sl::create([
                'sequence_id' => $sequence->id,
                'enquete_id'  => $enquete->id,
                'choice_id'   => null,
            ]);
        } else {
            $sequence = Sequence::where('user_id', $user->id)->where('token', $st)->first();
            $sls = $sequence->sls;
            $count = $sls->count();
            $ids = $sequence->sls->pluck('choice_id');
            $enquete = Enquete::whereNotIn('id', $ids)->inRandomOrder()->with('choices')->first();
            Sl::create([
                'sequence_id' => $sequence->id,
                'enquete_id'  => $enquete->id,
                'choice_id'   => null,
            ]);
        }
        return [
            'sequence_token' => $sequence->token,
            'enquete'        => $enquete,
            'count'          => $count ?? 0,
        ];
    }

    public function answer(Request $request)
    {
        $user       = User::where('token', $request->input('token'))->first();
        $sequence   = Sequence::where('token', $request->input('sequence_token'))->first();
        $sls = $sequence->sls;
        $sl = $sls->reverse()->first();
        $count = $sls->count();
        $sl->choice_id = $request->input('answer');
        $sl->save();
        return ['count' => $count];
    }
}
