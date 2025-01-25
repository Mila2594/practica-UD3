<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /**
        * User::factory()->create([
        *    'name' => 'Test User',
        *    'email' => 'test@example.com',
        * ]);
        */

        // Llamar a los seeders individuales
        $this->call([
            EspecialidadSeeder::class,
            AlumnoSeeder::class,
            TipoProyectoSeeder::class,
            ProyectoSeeder::class,
            ProfesorSeeder::class,
            SupervisionSeeder::class,
            EvaluacionSeeder::class,
            CalificacionFinalSeeder::class,
        ]);
    }
}
