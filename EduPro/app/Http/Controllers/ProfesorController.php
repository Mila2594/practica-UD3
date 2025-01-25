<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProfesorController extends Controller
{
    
    /**
     * mostrar todos los profesores. Index
     */
    public function index()
    {
        $profesor = Profesor::all();
        if($profesor->isEmpty()){
            return response()->json(['message' => 'No hay profesores registrados'], 404);
        }

        return response()->json($profesor, 200);
    }

    /**
     * crear un profesor con request. Store
     */
    public function store(Request $request)
    {
        //validar los datos
        $validator = Validator::make($request->all(),[
            'nombre' => 'required|string|max:80',
            'apellido' => 'required|string|max:80',
            'email' => 'required|email|max:150|unique:profesores,email',
            'dni' => 'required|size:8|max:8|unique:profesores,dni',
            'especialidad' => 'required|string|max:200',
        ]);

         // Si la validación falla, retorna un error 422
         if($validator->fails()){
            return response()->json([
                'message' => 'Los datos proporcionados no son válidos.',   
                'errors' => $validator->errors(),
            ], 422);
         }

        try{
            $profesor = Profesor::create($validator->validated());

            return response()->json([
                'message' => 'Profesor creado con éxito',
                'profesor' => $profesor,
            ], 201);
        } catch(\Exception $e){
            return response()->json([
                'message' => 'Hubo un error al intentar crear el profesor',
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * actualizar un profesor con request y id. Update
     */
    public function update(Request $request, $id)
    {
        $profesor = Profesor::find($id);

        if($profesor == null){
            return response()->json(['message' => 'Profesor no encontrado'], 404);
        }

        //validar los datos
        $validator = Validator::make($request->all(),[
            'nombre' => 'required|string|max:80',
            'apellido' => 'required|string|max:80',
            'email' => 'required|email|max:150|unique:profesores,email,'.$id,
            'dni' => 'required|size:8|max:8|unique:profesores,dni,'.$id,
            'especialidad' => 'required|string|max:200',
        ]);

         // Si la validación falla, retorna un error 422
         if($validator->fails()){
            return response()->json([
                'message' => 'Los datos proporcionados no son válidos.',
                'errors' => $validator->errors(),
            ], 422);
        }

        //reemplazar los datos del profesor con los nuevos datos
        $profesor->update($request->all());

        return response()->json([
            'message' => 'Profesor actualizado con éxito',
            'profesor' => $profesor,
        ] , 200);

    }

    /**
     * eliminar un profesor con id. Destroy
     */
    public function destroy($id)
    {
        $profesor = Profesor::find($id);

        if(!$profesor){
            return response()->json(['message' => 'Profesor no encontrado'], 404);
        }

        $profesor->delete();

        return response()->json([
            'message' => 'Profesor eliminado con éxito',
        ], 200);
    }

}
