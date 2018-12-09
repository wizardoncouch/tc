<?php

namespace App\Http\Middleware\Client\API;

use Closure;
use App\Admin\Client;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class Connect
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
        try{

            # Get the client token passed from form parameter
            $client_token = $request->get('_key');

            # Get the subdomain from the url
            list($subdomain) = explode('.', $request->getHost(), 2);

            # Get the client by subdomain
            $client = Client::whereSlug($subdomain)->first();

            if (!empty($client)) {

                # Client token passed is not authorized
                if ($client->token != $client_token) {
                    return response()->json('Client is not authorized', 401);
                }

                # Change to client specific db connection
                $db_username = $client->db_username;
                if(empty($db_username)){
                    $db_username = config('database.connections.main.username');
                }
                $db_password = $client->db_password;
                if(empty($db_password)){
                    $db_password = config('database.connections.main.password');
                }
                DB::purge('client');
                Config::set('database.connections.client.database', $client->db_name);
                Config::set('database.connections.client.username', $db_username);
                Config::set('database.connections.client.password', $db_password);
                DB::reconnect('client');
                Schema::connection('client')->getConnection()->reconnect();

            } else {

                return response()->json('Client is not found on the system', 404);
            }

            return $next($request);

        }catch(\Exception $e){

            Log::critical(__method__ . ':error', [$e->getMessage()]);
            return response()->json($e->getMessage(), 500);
            
        }
    }
}
