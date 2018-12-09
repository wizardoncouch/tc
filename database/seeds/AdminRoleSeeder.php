<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		DB::connection('main')->table('roles')->insert([
			['name' => 'admin'],
			['name' => 'template'],
			['name' => 'client'],
			['name' => 'finance']
    	]);
    }
}
