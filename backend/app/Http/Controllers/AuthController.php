<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\Auth\RegisterRequest;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // $data = $request->input();
        // $data['login_id'] = $data['id'];
        // unset($data['id']);
        // $user = $this->create($data);
        $user = User::demo();
        return ['token' => $user->token];
    }

    private function create(array $data) : User
    {
        do {
            $token = str_random(40);
        } while (User::where('token', $token)->exists());
        $user = User::make($data);
        $user->token = $token;
        $user->save();
        return User::where('login_id', $data['login_id'])->first();
    }
}
