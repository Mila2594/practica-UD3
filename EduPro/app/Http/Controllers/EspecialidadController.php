<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    /**
     * mostrar todas las especialidades. Index
     */
    public function index()
    {
        $especialidades = Especialidad::all();
        if($especialidades->isEmpty()){
            return response()->json(['message' => 'No hay especialidades registradas'], 404);
        } 

        return response()->json($especialidades, 200);
    }

    /**
     * Mostrar proyectos de una especialidad. getProyectos
     */
    public function getProyectos($id)
    {
        $especialidad = Especialidad::find($id);
        if($especialidad == null){
            return response()->json(['message' => 'Especialidad no encontrada'], 404);
        }

        // buscar proyectos segun la especialidad, se accede al proyecto por la tabla alumnos
        $proyectos = $especialidad->alumnos()
            ->with(['proyectos'])
            ->get()
            ->flatMap(function($alumno){
                return $alumno->proyectos;
            })
            ->unique('id')
            ->values();

            // Si no hay proyectos, se devuelve una lista vacía
            if ($proyectos->isEmpty()) {
                return response()->json([
                    'especialidad' => $especialidad->nombre,
                    'proyectos' => [],
                    'message' => 'No hay proyectos asociados a esta especialidad'
                ], 200);
            }

            return response()->json([
                'especialidad' => $especialidad->nombre,
                'proyectos' => $proyectos,
            ], 200);
    }

    /**
     * Mostrar alumnos de una especialidad. getAlumnos
     */
    public function getAlumnos($id)
    {
        $especialidad = Especialidad::find($id);
        if($especialidad == null){
            return response()->json(['message' => 'Especialidad no encontrada'], 404);
        }

        // buscar alumnos segun la especialidad
        $especialidad = Especialidad::with('alumnos')->findOrFail($id);
        
        // Si no hay alumnos, devolver lista vacía
        if ($especialidad->alumnos->isEmpty()) {
            return response()->json([
                'especialidad' => $especialidad->nombre,
                'alumnos' => [],
                'message' => 'No hay alumnos asociados a esta especialidad'
            ], 200);
        }

        return response()->json([
            'especialidad' => $especialidad->nombre,
            'alumnos' => $especialidad->alumnos,
        ]);
    }
}
