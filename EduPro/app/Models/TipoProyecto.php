<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProyecto extends Model
{
    use HasFactory;

    protected $fillable=['nombre','descripcion'];


    /**
     * Relación con el proyecto (un tipo de proyecto puede estar relacion con 0 o varios proyectos)
     */
    public function proyecto()
    {
        return $this->hasMany(Proyecto::class, 'tipo_proyecto_id');
    }
}
