<?php

namespace App\Http\Controllers;

use App\Models\Supervision;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SupervisionController extends Controller
{
    /**
     * mostrar todas las supervisiones. Index
     */
    public function index()
    {
        $supervisiones = Supervision::all();
        if($supervisiones->isEmpty()){
            return response()->json(['message' => 'No hay supervisiones registradas'], 404);
        } 

        return response()->json($supervisiones, 200);
    }
}
