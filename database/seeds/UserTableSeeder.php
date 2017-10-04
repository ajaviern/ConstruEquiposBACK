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
        //
        DB::table('users')->insert([
            'cedula' =>1065564568,
            'name' => 'SuperAdmin',
            'apellido' => 'SuperAdmin',
            'telefono' => '3156901816',
            'rol' => 'SuperAdmin',
            'email' => 'SuperAdmin@gmail.com',
            'password' => 'admin',
            //'password' => bcrypt('admin'),
        ]);

        //
        DB::table('users')->insert([
            'cedula' =>1065564567,
            'name' => 'Admin',
            'apellido' => 'Admin',
            'telefono' => '3002744511',
            'rol' => 'Admin',
            'email' => 'Admin@gmail.com',
            'password' => 'admin',
            //'password' => bcrypt('admin'),
        ]);
    }
}
