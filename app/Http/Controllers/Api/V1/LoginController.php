<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


    public function login(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            $token = $user->createToken('MyApp')->accessToken;

            return response()->json([
                'message' => 'User logged successfully',
                'token' => $token
            ], 200);
        } else {
            return response()->json(['message' => 'Unauthorised'], 401);
        }
    }
}
