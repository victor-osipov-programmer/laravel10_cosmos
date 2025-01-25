<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        $request->setUserResolver(function () use($token) {
            return User::where('token', $token)->first();
        });

        $user = $request->user();

        if (!isset($user)) {
            return response([
                'message' => 'Login failed'
            ], 403);
        }


        return $next($request);
    }
}
