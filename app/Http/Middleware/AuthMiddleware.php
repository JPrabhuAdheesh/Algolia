<?php

namespace App\Http\Middleware;

use Closure;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
// check for api token in the request header
    $token = $request->header('API-TOKEN');
    //dd($token);
    if($token != config('app.algolia.api_token'))
    return response()->json(['success' => false, 
    'message' => "Unauthorized request! API Token not found."], 401);
    return $next($request);
    }
}
