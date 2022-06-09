<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function register(CreateUserRequest $request)
    {
        if (!User::where('username', $request->username)->first()) {
            $user = new User();
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            return [
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'option' => 'create',
                'status' => 'success'
            ];
        }
        return [
            'name' => null,
            'username' => null,
            'email' => null,
            'option' => 'create',
            'status' => 'error'
        ];
    }
}
