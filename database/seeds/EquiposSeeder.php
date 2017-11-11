<?php

use Illuminate\Database\Seeder;

class EquiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('equipos')->insert([
            'categoria' =>1,
            'descripcion'=>'Moto Pulidora',
            'modelo'=>"YAMAHA 54453",
            'estado'=>'Activo',
            'cantidad'=>3
        ]);
        DB::table('equipos')->insert([
            'categoria' =>2,
            'descripcion'=>'Andamios',
            'modelo'=>"XFY 4567 233",
            'estado'=>'Activo',
            'cantidad'=>20
        ]);
        DB::table('equipos')->insert([
            'categoria' =>1,
            'descripcion'=>'Martillo Electrico',
            'modelo'=>"ZZ 9000",
            'estado'=>'Activo',
            'cantidad'=>45
        ]);
        DB::table('equipos')->insert([
            'categoria' =>3,
            'descripcion'=>'Pulidora',
            'modelo'=>"3233 ASP",
            'estado'=>'Activo',
            'cantidad'=>4
        ]);
    }
}
