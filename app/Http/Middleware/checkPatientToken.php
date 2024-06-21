<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth ;

class checkPatientToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = null ;
        try{
            $user = JWTAuth::parseToken()->authenticate();
        }catch(\Exception $e){
            if($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException)
            {
                return response()->json(['msg' => 'Invalid Token' ]);
            }
            else if($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException)
            {
                return response()->json(['success' => false,'msg' => 'Expired Token' ]);
            }
            else
            {
                return response()->json(['success' => false, 'msg' => 'Token Not Found' ]);
            }
        }catch(\Throwable $e){
            if($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException)
            {
                return response()->json(['msg' => 'Invalid Token' ]);
            }
            else if($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException)
            {
                return response()->json(['success' => false,'msg' => 'Expired Token' ]);
            }
            else
            {
                return response()->json(['success' => false, 'msg' => 'Token Not Found' ]);
            }
        }

        if(! $user)
        return response()->json(['msg' => 'Unauthenticated']);

        return $next($request);
    }
}
