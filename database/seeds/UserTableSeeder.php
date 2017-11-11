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
            'name' => 'Hernesto',
            'apellido' => 'Costilla Camelo',
            'telefono' => '3156901816',
            'rol' => 'administrador',
            'email' => 'superadmin@construequipos.com',
            //'password' => 'admin',
            'password' => bcrypt('123456')
        ]);

        //
        DB::table('users')->insert([
            'cedula' =>1065564567,
            'name' => 'Juan',
            'apellido' => 'Gonzales',
            'telefono' => '3002744511',
            'rol' => 'usuario',
            'email' => 'usuario@gmail.com',
            //'password' => 'admin',
            'password' => bcrypt('123456'),
        ]);
    }
}
