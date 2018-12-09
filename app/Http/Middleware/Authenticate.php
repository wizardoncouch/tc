<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
        # Get the subdomain from the url
        list($subdomain) = explode('.', $request->getHost(), 2);
        switch ($subdomain) {
            case 'admin':
                return route('admin.login.show');
                break;
            case 'client':
                return route('client.login.show');
                break;
        }
    }
}
