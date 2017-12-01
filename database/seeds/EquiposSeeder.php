<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
            'cantidad'=>500,
            'totalExistencias'=>500,
            'valor'=>10000,
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('equipos')->insert([
            'categoria' =>2,
            'descripcion'=>'Andamios',
            'modelo'=>"XFY 4567 233",
            'estado'=>'Activo',
            'cantidad'=>400,
            'valor'=>25000,
            'totalExistencias'=>400,
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('equipos')->insert([
            'categoria' =>1,
            'descripcion'=>'Martillo Electrico',
            'modelo'=>"ZZ 9000",
            'estado'=>'Activo',
            'cantidad'=>300,
            'totalExistencias'=>300,
            'valor'=>45000,
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('equipos')->insert([
            'categoria' =>3,
            'descripcion'=>'Pulidora',
            'modelo'=>"3233 ASP",
            'estado'=>'Activo',
            'cantidad'=>50,
            'totalExistencias'=>50,
            'valor'=>95000,
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
