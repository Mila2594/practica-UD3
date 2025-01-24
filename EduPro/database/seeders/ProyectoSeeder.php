<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Proyecto;
use App\Models\TipoProyecto;
use Faker\Factory as Faker;

class ProyectoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for($i = 0; $i <10; $i++){
            Proyecto::create([
                'titulo'=>$faker->sentence,
                'descripcion'=>$faker->paragraph,
                'tipo_proyecto_id'=>TipoProyecto::inRandomOrder()->first()->id,
                'fecha_inicio'=>$faker->date(),
                'fecha_limite'=>$faker->date(),
            ]);
        }
    }
}
