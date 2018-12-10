<?php

namespace App\Jobs\Admin;

use App\Admin\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use PDO;
use Exception;

class CreateClient implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var $client
     */
    protected $client;

    /**
     * Create a new job instance.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        //
        $this->client = $client;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle()
    {
        try {

            if (empty($this->client->db_name)) {
                Log::error(__method__, ['empty-db->name' => $this->client]);
                return false;
            }
            $pdo = $this->_getPDOConnection(config('database.connections.main.host'), config('database.connections.main.port'), config('database.connections.main.username'), config('database.connections.main.password'));
            if($pdo->exec(sprintf(
                'CREATE DATABASE IF NOT EXISTS %s CHARACTER SET %s COLLATE %s;',
                $this->client->db_name,
                'utf8mb4',
                'utf8mb4_unicode_ci'
            ))){
                Log::info(__method__, ['client-added' => $this->client]);
            }
            try {
                Config::set('database.connections.client.database', $this->client->db_name);
                Config::set('database.connections.client.username', config('database.connections.main.username'));
                Config::set('database.connections.client.password', config('database.connections.main.password'));
                Artisan::call('migrate', ['--database' => 'client', '--path' => 'database/migrations/client', '--force' => true]);
                Log::info(__method__, ['client-database-configured' => $this->client]);
            } catch (Exception $e) {
                Log::error(__method__, ['create-client-migration-error' => $e->getMessage()]);
            }
        } catch (Exception $e) {
            Log::error(__method__, ['create-client-error' => $e->getMessage()]);
        }

    }

    /**
     * Connect to database
     * @param  [type] $host     [description]
     * @param  [type] $port     [description]
     * @param  [type] $username [description]
     * @param  [type] $password [description]
     * @return PDO
     */
    private function _getPDOConnection($host, $port, $username, $password)
    {
        return new PDO(sprintf('mysql:host=%s;port=%d;', $host, $port), $username, $password);
    }
}
