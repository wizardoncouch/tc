<?php

namespace App\Console\Commands\Client;

use Illuminate\Console\Command;
use App\Admin\Client;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Exception;
use PDO;
use PDOException;

class Migrate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tc:client-migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set up database for the client.';

    #database host
    protected $host;

    #database port
    protected $port;

    #database username
    protected $username;

    #database password
    protected $password;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->host = config('database.connections.main.host');
        $this->port = config('database.connections.main.port');
        $this->username = config('database.connections.main.username');
        $this->password = config('database.connections.main.password');
        
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    
    public function handle()
    {
        $this->_getPDOConnection($this->host, $this->port, $this->username, $this->password);

        try{
            $clients = Client::whereIsActive(true)->get();
            foreach ($clients as $client) {
                $this->_migrate($client);
            }
        }catch(Exception $e){
            $this->error($e->getMessage());
        }
    }

    /**
     * Execute migration artisan command for a specific client
     * @param  [type] $client [description]
     * @return void [type]          [description]
     */
    public function _migrate($client){
        try{
            $type = $this->argument('type');

            Config::set('database.connections.client.database', $client['db_name']);
            Config::set('database.connections.client.username', $this->username);
            Config::set('database.connections.client.password', $this->password);
            if($type > ''){
                Artisan::call('migrate:'.$type, ['--database' => 'client', '--path' => 'database/migrations/client', '--force' => true]);
                $this->info($client['name'] .' migration ('.$type.').');
            }else{
                Artisan::call('migrate', ['--database' => 'client', '--path' => 'database/migrations/client', '--force' => true]);
                $this->info($client['name'] .' migration executed.');
            }
        }catch(\Exception $e){
            $this->error($e->getMessage());
        }

    }

    /**
     * Connect to database
     * @param $host
     * @param $port
     * @param $username
     * @param $password
     * @return PDO [type]           [description]
     */
    private function _getPDOConnection($host, $port, $username, $password){
        new PDO(sprintf('mysql:host=%s;port=%d;', $host, $port), $username, $password);
    }
}
