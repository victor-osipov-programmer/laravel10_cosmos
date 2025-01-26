<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    function authorization(Request $request) {
        $data = $request->validate([
            'email' => ['required', Rule::exists('users')],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt($data)) {
            return response([
                'message' => 'Login failed'
            ], 403);
        }

        $user = $request->user();
        $new_token = Str::random(15);
        $user->update([
            'token' => $new_token
        ]);

        return response([
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->first_name . ' ' . $user->last_name . ' ' . $user->patronymic,
                    'birth_date' => $user->birth_date,
                    'email' => $user->email
                ],
                'token' => $new_token
            ]
        ]);
    }


    function logout(Request $request) {
        $user = $request->user();
        
        $user->update([
            'token' => null
        ]);

        return response()->noContent();
    }
}
