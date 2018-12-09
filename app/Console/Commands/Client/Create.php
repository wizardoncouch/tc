<?php

namespace App\Console\Commands\Client;

use Illuminate\Console\Command;
use App\Admin\Client;
use App\Admin\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use PDO;
use PDOException;

class Create extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tc:client-create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new client.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $details = null;
        while($details == null){
            $details = $this->_getDetails();
            $this->line('Name: '.$details['name']);
            $this->line('Slug: '.$details['slug']);
            if (!$this->confirm('Check the details above. Do you wish to continue?')) {
                $details = null;
            }
        }
        if($this->_createDatabase($details)){
            $this->_process($details);
        }
    }

    /**
     * Input client details
     * @return [type] [description]
     */
    private function _getDetails(){
        $client_name = $this->ask('What is your client name?');
        $unique = false;
        $again = false;
        while(!$unique){
            if($again){
                $client_slug = $this->ask('Client alias already in use. Please choose another.');
            }else{
                $client_slug = $this->ask('What is your client alias? It will be used for subdomain {alias}.teamconsole.io (lowercase).');
            }
            $check = Client::whereSlug($client_slug)->whereIsActive(true)->exists();
            if(!$check){
                $unique = true;
            }else{
                $again = true;
            }
        }
        return [
            'name' => trim($client_name),
            'slug' => trim($client_slug),
            'db' => trim('tc_'.$client_slug)
        ];
    }
    /**
     * Create the client with it's settings.
     * @param  [type] $details [description]
     * @return [type]          [description]
     */
    private function _process($details){
        try{
            $user = User::whereType('admin')->whereIsActive(true)->first();
            $client = new Client();
            $client->user_id = $user->id;
            $client->slug = strtolower($details['slug']);
            $client->name = $details['name'];
            $client->token = str_random(32);
            $client->db_name = $details['db'];
            $client->is_active = true;
            $client->save();
            $this->info('Client successfully added.');
        }catch(\Exception $e){
            $this->error($e->getMessage());
        }
    }

    /**
     * Create the database and tables for the client.
     * @param  [type] $details [description]
     * @return [type]          [description]
     */
    private function _createDatabase($details){
        try{

            if(empty($details['db'])){
                $this->error('DB name is empty.');
                return false;
            }
            $pdo = $this->_getPDOConnection(env('DB_HOST'), env('DB_PORT'), env('DB_USERNAME'), env('DB_PASSWORD'));
            $pdo->exec(sprintf(
                'CREATE DATABASE IF NOT EXISTS %s CHARACTER SET %s COLLATE %s;',
                $details['db'],
                'utf8mb4',
                'utf8mb4_unicode_ci'
            ));

            try{
                Config::set('database.connections.client.database', $details['db']);
                Config::set('database.connections.client.username', env('DB_USERNAME'));
                Config::set('database.connections.client.password', env('DB_PASSWORD'));
                Artisan::call('migrate', ['--database' => 'client', '--path' => 'database/migrations/client', '--force' => true]);
            }catch(\Exception $e){
                $this->error($e->getMessage());
            }

            $this->info('Client database setup successfully.');

            return true;

        }catch(\Exception $e){

            $this->error($e->getMessage());
            return false;

        }
    }

    /**
     * Connect to database
     * @param  [type] $host     [description]
     * @param  [type] $port     [description]
     * @param  [type] $username [description]
     * @param  [type] $password [description]
     * @return [type]           [description]
     */
    private function _getPDOConnection($host, $port, $username, $password){
        return new PDO(sprintf('mysql:host=%s;port=%d;', $host, $port), $username, $password);
    }
}
