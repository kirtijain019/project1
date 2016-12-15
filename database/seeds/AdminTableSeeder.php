<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->insert([
        'email'=> 'admin'.'@gmail.com',
        'password' => bcrypt('abc'),
         ]);
        
    }
}
