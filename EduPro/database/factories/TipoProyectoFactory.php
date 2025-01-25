<?php

namespace Database\Factories;

use App\Models\TipoProyecto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TipoProyecto>
 */
class TipoProyectoFactory extends Factory
{
    protected $model = TipoProyecto::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->unique()->randomElement([
                'Tesis',                   
                'Doctorado',                
                'Seminario',                
                'Trabajo de fin de grado',  
                'Memoria de Investigación', 
                'PFC (Proyecto Final de Carrera)', 
                'Trabajo de campo',         
                'Estudio de caso',          
                'Investigación aplicada',               
            ]),
            'descripcion' => $this->faker->sentence,
        ];
    }
}
