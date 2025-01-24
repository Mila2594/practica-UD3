<?php

namespace Database\Factories;

use App\Models\Especialidad;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Especialidad>
 */
class EspecialidadFactory extends Factory
{
    protected $model = Especialidad::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->unique()->randomElement([
                'Ingeniería en Sistemas', 
                'Administración de Empresas', 
                'Medicina', 
                'Arquitectura', 
                'Derecho', 
                'Psicología', 
                'Educación', 
                'Contabilidad', 
                'Diseño Gráfico', 
                'Ciencias de la Comunicación'
            ]),
            'descripcion' => $this->faker->sentence, // Genera una breve descripción ficticia
        ];
    }
}
