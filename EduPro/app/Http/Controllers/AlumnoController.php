<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    /**
     * mostrar todos los alumnos. Index
     */
    public function index()
    {
        $alumnos = Alumno::all();
        if($alumnos->isEmpty()){
            return response()->json(['message' => 'No hay alumnos registrados'], 404);
        } 

        return response()->json($alumnos, 200);
    }

    /**
     * mostrar un alumno. Show
     */
    public function show($id)
    {
        $alumno = Alumno::find($id);
        if($alumno == null){
            return response()->json(['message' => 'Alumno no encontrado'], 404);
        }

        return response()->json($alumno, 200);
    }

    /**
     * crear un alumno con request. Store
     */
    public function store(Request $request)
    {
        //validar los datos
        $validator = Validator::make($request->all(),[
            'nombre' => 'required|string|max:80',
            'apellido' => 'required|string|max:80',
            'email' => 'required|email|unique:alumnos,email|max:150',
            'curso' => 'required|string|max:10',
            'dni' => 'required|size:8|unique:alumnos,dni|max:8',
            'especialidad_id' => 'nullable|exists:especialidades,id',
        ]);

         // Si la validación falla, retorna un error 422
         if($validator->fails()){
            return response()->json([
                'message' => 'Los datos proporcionados no son válidos.',
                'errors' => $validator->errors(),
            ], 422);
         }

         //intentar crear el alumno
         try{
            $alumno = Alumno::create($validator->validated()); // Usar los datos validados

            //si el alumno se crea con exito se retorna un mensaje 201
            return response()->json([
                'message' => 'Alumno creado con éxito',
                'alumno' => $alumno,
            ], 201);
         } catch(\Exception $e){
            //si ocurre un error al crear el alumno se retorna un mensaje 400 (error de no se pudo crear el recurso)
            return response()->json([
                'message' => 'Hubo un problema al intentar crear el alumno.',
                'error' => $e->getMessage(),
            ], 400);
         }

    }

    /**
     * actualizar un alumno con request y id. Update
     */
    public function update(Request $request, $id)
    {
        //validar si el alumno existe
        $alumno = Alumno::find($id);

        if($alumno == null){
            return response()->json(['message' => 'Alumno no encontrado'], 404);
        }

        //validar que todos los datos esten presentes y sean correctos
        $validator = Validator::make($request->all(),[
            'nombre' => 'required|string|max:80',
            'apellido' => 'required|string|max:80',
            'email' => 'required|email|max:150|unique:alumnos,email,'.$id,
            'curso' => 'required|string|max:10',
            'dni' => 'required|size:8|max:8|unique:alumnos,dni,'.$id,
            'especialidad_id' => 'nullable|exists:especialidades,id',
        ]);

        // Si la validación falla, retorna un error 422
        if($validator->fails()){
            return response()->json([
                'message' => 'Los datos proporcionados no son válidos.',
                'errors' => $validator->errors(),
            ], 422);
        }

        //reemplazar los datos del alumno con los nuevos datos
        $alumno->update($request->all());

        return response()->json([
            'message' => 'Alumno actualizado con éxito',
            'alumno' => $alumno,
        ], 200);

    }

    /**
     * eliminar un alumno con id. Destroy
     */
    public function destroy($id)
    {
        //validar si el alumno existe
        $alumno = Alumno::find($id);

        if(!$alumno){
            return response()->json(['message' => 'Alumno no encontrado'], 404);
        }

        //eliminar el alumno
        $alumno->delete();

        return response()->json([
            'message' => 'Alumno eliminado con éxito',
        ], 200);
    }

    /**
     * mostrar los proyectos de un alumno. getProyectos
     */
    public function getProyectos($id)
    {
        $alumno = Alumno::find($id);

        if($alumno == null){
            return response()->json(['message' => 'Alumno no encontrado'], 404);
        }

        $proyectos = $alumno->proyectos;

        return response()->json([
            'aluno' => $alumno->nombre,
            'proyectos' => $proyectos,
        ], 200);
    }


}
