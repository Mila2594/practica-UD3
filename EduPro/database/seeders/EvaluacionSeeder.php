<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Evaluacion;
use App\Models\Profesor;
use App\Models\Proyecto;
use Faker\Factory as Faker;

class EvaluacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $proyectos = Proyecto::all();
        $profesores = Profesor::all();

        if($profesores->isNotEmpty() && $proyectos->isNotEmpty()){
            foreach(range(1,15) as $index){
                Evaluacion::create([
                    'fecha' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                    'comentario' => $faker->optional()->sentence(),
                    'calificacion' => $faker->randomFloat(2, 0, 10), // Calificación entre 0 y 10
                    'profesor_id' => $profesores->random()->id, // Profesor aleatorio
                    'proyecto_id' => $proyectos->random()->id,  // Proyecto aleatorio
                ]);
            }
        }else {
            $this->command->info('No hay profesores o proyectos disponibles para generar evaluaciones.');
        }
    }
}
