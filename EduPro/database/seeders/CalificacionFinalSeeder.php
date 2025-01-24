<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CalificacionFinal;
use App\Models\Proyecto;
use Faker\Factory as Faker;


class CalificacionFinalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        //obetener proyectos existentes
        $proyectos = Proyecto::all();

        if ($proyectos->isNotEmpty()) {         
            foreach (range(1, 7) as $index) {
                CalificacionFinal::create([
                    'fecha_cierre' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                    'comentario' => $faker->optional()->sentence(),
                    'proyecto_id' => $proyectos->random()->id, // Asignar un proyecto aleatorio de los existentes
                ]);
            }
        } else {
            $this->command->info('No hay proyectos disponibles para generar calificaciones finales.');
        }
    }
}
