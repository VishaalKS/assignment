<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class VerifyJwtFromCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $_COOKIE['token'] ?? null;

        if(!$token) {
            return response()->redirectToRoute('auth.showLogin');
        }

        try{
            $user = JWTAuth::setToken($token)->authenticate();

        }catch(\Exception $e) {
            return response()->redirectToRoute('auth.showLogin');
        }

        $request->attributes->set('user',$user);

        return $next($request);
    }
}
