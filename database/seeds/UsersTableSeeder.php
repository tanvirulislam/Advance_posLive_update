<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([
            'role_id' => '1',
            'name' => 'Mr.Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('rootadmin'),
        ]);
        DB::table('users')->insert([
            'role_id' => '2',
            'name' => 'Mr.User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('rootuser'),
        ]);
         DB::table('users')->insert([
            'role_id' => '3',
            'name' => 'Mr.Agent',
            'email' => 'agent@gmail.com',
            'password' => bcrypt('rootagent'),
        ]);
          DB::table('users')->insert([
            'role_id' => '4',
            'name' => 'Mr.Merchant',
            'email' => 'mer@gmail.com',
            'password' => bcrypt('rootmer'),
        ]);

          DB::table('users')->insert([
            'role_id' => '5',
            'name' => 'Mr.Vip',
            'email' => 'vip@gmail.com',
            'password' => bcrypt('rootvip'),
        ]);
    }
}
