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
            'cantidad'=>3,
            'valor'=>10000,
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('equipos')->insert([
            'categoria' =>2,
            'descripcion'=>'Andamios',
            'modelo'=>"XFY 4567 233",
            'estado'=>'Activo',
            'cantidad'=>20,
            'valor'=>25000,
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('equipos')->insert([
            'categoria' =>1,
            'descripcion'=>'Martillo Electrico',
            'modelo'=>"ZZ 9000",
            'estado'=>'Activo',
            'cantidad'=>45,
            'valor'=>45000,
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('equipos')->insert([
            'categoria' =>3,
            'descripcion'=>'Pulidora',
            'modelo'=>"3233 ASP",
            'estado'=>'Activo',
            'cantidad'=>4,
            'valor'=>95000,
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
