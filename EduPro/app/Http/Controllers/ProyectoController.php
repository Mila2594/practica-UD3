<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProyectoController extends Controller
{

    /**
     * Mostrar todos los proyectos. Index
     */
    public function index()
    {
        $proyectos = Proyecto::all();
        if($proyectos->isEmpty()){
            return response()->json(['message' => 'No hay proyectos registrados'], 404);
        }

        return response()->json($proyectos, 200);
    }

    /**
     * Crear un proyecto con request. Store
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'titulo' => 'required|string|max:150',
            'descripcion' => 'required|string',
            'tipo_proyecto_id' => 'nullable|exists:tipos_proyectos,id',
            'fecha_inicio' => 'required|date',
            'fecha_limite' => 'required|date',
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => 'Los datos proporcionados no son válidos.',
                'errors' => $validator->errors(),
            ], 422);
        }

        try{
            
            $proyecto = Proyecto::create($validator->validated());

            return response()->json([
                'message' => 'Proyecto creado con éxito',
                'proyecto' => $proyecto,
            ], 201);
        }catch(\Exception $e){
            return response()->json([
                'message' => 'Hubo un problema al intentar crear el proyecto',
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Mostrar calificación final de un proyecto por su id. getCalificacionFinal
     */
    public function getCalificacionFinal($id)
    {
        //validar si el proyecto existe
        $proyecto = Proyecto::find($id);

        if($proyecto == null){
            return response()->json([
                'message' => 'Proyecto no encontrado'], 
                404);
        }

        //si el proyecto existe, buscar la calificación final en la tabla calificaciones_finales
        $proyecto = Proyecto::with('calificacionFinal')->findOrFail($id);

        // Verificar si existe una calificación final
    if (!$proyecto->calificacionFinal) {
        return response()->json([
            'message' => 'El proyecto no tiene calificación final',
            'calificacion_final' => [],
        ], 200);
    }

        return response()->json($proyecto->calificacionFinal, 200);

    }

    /**
     * Mostrar evaluaciones y calificación final de un proyecto por su id. getEvaluaciones
     */
    public function getEvaluaciones($id)
    {
        $proyecto = Proyecto::find($id);
        if($proyecto == null){
            return response()->json([
                'message' => 'Proyecto no encontrado'], 
                404);
        }

        $proyecto = Proyecto::with('evaluaciones', 'calificacionFinal')->findOrFail($id);

        // Verificar si existen evaluaciones
        $evaluaciones = $proyecto->evaluaciones->isEmpty() ? [] : $proyecto->evaluaciones;

        // Verificar si existe una calificación final
        $calificacionFinal = $proyecto->calificacionFinal ? $proyecto->calificacionFinal : [];

        return response()->json([
            'evaluaciones' => $proyecto->evaluaciones,
            'calificacion_final' => $proyecto->calificacionFinal,
        ], 200);
        
    }

}
