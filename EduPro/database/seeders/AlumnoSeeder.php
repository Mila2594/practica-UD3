<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Alumno;
use App\Models\Especialidad;
use Faker\Factory as Faker;

class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Generar 10 registros de alumnos
        for ($i = 0; $i < 10; $i++){
            Alumno::create([
                'nombre'=>$faker->firstName,
                'apellido'=>$faker->lastName,
                'email'=>$faker->unique()->safeEmail,
                'curso'=>$faker->randomElement(['1º','2º','3º','4º','5º','6º','7º','8º','9º','10º']),
                'dni'=>$faker->unique()->lexify('########?'),
                'especialidad_id'=>Especialidad::inRandomOrder()->first()->id, 
            ]);

        }
    }
}
