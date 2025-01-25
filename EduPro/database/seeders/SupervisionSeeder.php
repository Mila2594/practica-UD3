<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supervision;
use App\Models\Profesor;
use App\Models\Alumno;
use App\Models\Proyecto;
use Faker\Factory as Faker;


class SupervisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

         // Obtiene aleatoriamente algunos alumnos, profesores y proyectos
         $alumnos = Alumno::all();
         $profesores = Profesor::all();
         $proyectos = Proyecto::all();

         // Verifica que haya suficientes alumnos, profesores y proyectos
        if ($alumnos->count() > 0 && $profesores->count() > 0 && $proyectos->count() > 0) {
            // Crea supervisiones aleatorias
            foreach (range(1, 10) as $index) {
                Supervision::create([
                    'fecha_asig' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                    'rol' => $faker->randomElement(['tutor', 'cotutor']),
                    'alumno_id' => $alumnos->random()->id, // Selecciona un alumno aleatorio
                    'proyecto_id' => $proyectos->random()->id, // Selecciona un proyecto aleatorio
                    'profesor_id' => $profesores->random()->id, // Selecciona un profesor aleatorio
                ]);
            }
        } else {
            echo "Asegúrate de que hay alumnos, profesores y proyectos en la base de datos.\n";
        }
    }
}
