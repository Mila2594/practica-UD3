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
            AlumnoSeeder::class,
            CalificacionFinalSeeder::class,
            EspecialidadSeeder::class,
            EvaluacionSeeder::class,
            ProfesorSeeder::class,
            ProyectoSeeder::class,
            TipoProyectoSeeder::class,
            SupervisionSeeder::class,
        ]);
    }
}
