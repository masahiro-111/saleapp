<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        //
        DB::table('users')->insert([
            'name' =>  'testuser',
            'password' => Hash::make('//admin//'),
            'admin' => 1,
        ]);
    }
}
