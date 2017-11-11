<?php

use Illuminate\Database\Seeder;

class CategoriasEquiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categoriaequipo')->insert([
            'categoria' =>"Maquinaria Pesada",
        ]);
        DB::table('categoriaequipo')->insert([
            'categoria' =>"Construccion",
        ]);
        DB::table('categoriaequipo')->insert([
            'categoria' =>"Taller y Reparaciones",
        ]);

    }
}
