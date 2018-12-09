<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Admin\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = DB::connection('main')->table('roles')->whereName('admin')->first();
        $user = new User;
        $user->name = 'Alex Culango';
        $user->email = 'alex.culango@gmail.com';
        $user->password = \Hash::make('p4ssw0rd');
        $user->active = true;
        $user->code = str_random(6);
        $user->activated_at = date('Y-m-d H:i:s');
        $user->save();
        $user->roles()->attach($admin->id);
    }
}
