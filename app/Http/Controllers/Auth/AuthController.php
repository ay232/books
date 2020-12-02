<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\APIBaseController;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends APIBaseController
{
    public function login(UserLoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->sendError(['Wrong credentials']);
        }

        $token = $user->createToken('simple')->plainTextToken;

        return $this->sendResponse($token);
    }

}
