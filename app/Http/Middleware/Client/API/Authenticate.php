<?php

namespace App\Http\Middleware\Client\API;

use Closure;
use App\Project\Common\User;
use Illuminate\Support\Facades\Auth;

class Authenticate
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
        # Get the authorization key passed in header
        $auth = $request->header('Authorization');

        if (!empty($auth)) {
            # Check if user exists
            $user = User::whereApiToken($auth)->whereIsActive(true)->first();
            if(!$user){
                return response()->json('Unauthorized', 401);
            }
            # Login user to Auth
            Auth::login($user);
        }else{
            return response()->json('Unauthorized', 401);
        }

        return $next($request);

    }
}
