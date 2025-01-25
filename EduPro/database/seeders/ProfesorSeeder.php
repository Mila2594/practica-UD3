<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profesor;
use Faker\Factory as Faker;

class ProfesorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Definir un arreglo de profesiones
        $profesiones = [
            'Ingeniería en Sistemas',
            'Diseño Industrial',
            'Arquitectura',
            'Medicina',
            'Derecho',
            'Psicología',
            'Contabilidad',
            'Educación',
            'Ciencias de la Computación',
            'Comunicación Social'
        ];

        for($i = 0; $i < 10; $i++){
            Profesor::create([
                'nombre'=>$faker->firstName,
                'apellido'=>$faker->lastName,
                'email'=>$faker->unique()->safeEmail,
                'dni'=>$faker->unique()->regexify('[0-9]{7}[A-Z]{1}'),
                'especialidad'=>$faker->randomElement($profesiones)
            ]);
        }
    }
}
