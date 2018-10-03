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
        	'name' => 'Arsalan Yaldram',
        	'username' => 'yaldram',
        	'email' => 'admin@admin.com',
        	'password' => bcrypt('admin0211')
        ]);

        DB::table('users')->insert([
        	'role_id' => '2',
        	'name' => 'Arsalan Yaldram',
        	'username' => 'arsalan',
        	'email' => 'author@author.com',
        	'password' => bcrypt('author0211')

        ]);
    }
}
