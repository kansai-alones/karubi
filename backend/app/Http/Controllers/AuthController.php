<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AuthController extends Controller
{
    public function register(\App\Http\Requests\Auth\RegisterRequest $request)
    {
        $data = $request->input();
        $data['login_id'] = $data['id'];
        unset($data['id']);
        $user = $this->create($data);
        return ['token' => $user->token];
    }

    private function create(array $data) : User
    {
        do {
            $token = str_random(40);
        } while (User::where('token', $token)->exits());
        $user = User::make($data);
        $user->token = $token;
        $user->save();
        return User::where('login_id', $data['login_id'])->first();
    }
}
