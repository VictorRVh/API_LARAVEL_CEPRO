<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;

    protected $table = "especialidad";

    protected $fillable = [
        'id_unidad',
        'programa_estudio',
        'ciclo_formativo',
        'modalidad',
        'modalidad',
        'modulo_formativo',
        'descripcion_especialidad',
        'docente_id',
        'periodo_academico',
        'hora_semanal',
        'seccion',
        'tuno'
    ];
    public function docente()
    {
        return $this->belongsTo(Docente::class, 'docente_id', 'dni');
    }
}
