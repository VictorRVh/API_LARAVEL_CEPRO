<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Models\Especialidad;

class FichaMatricula extends Controller
{
    public function getEstudianteWithEspecialidadAndUnidades($codigoEstudiante)
    {
        $estudiante = Estudiante::with(['matricula.especialidad.unidadesDidacticas'])
            ->where('codigo_estudiante', $codigoEstudiante)
            ->first();

        if (!$estudiante) {
            return response()->json(['error' => 'Estudiante no encontrado'], 404);
        }

        // Mapea la información que deseas enviar en la respuesta
        $response = [
            'codigo_estudiante' => $estudiante->codigo_estudiante,
            'nombre_completo' => $estudiante->nombre . ' ' . $estudiante->apellido_paterno . ' ' . $estudiante->apellido_materno,
            'correo' => $estudiante->correo,
            'especialidad' => [
                'nombre' => $estudiante->matricula->especialidad->programa_estudio,
                'docente' => $estudiante->matricula->especialidad->docente->nombre . ' ' . $estudiante->matricula->especialidad->docente->apellido_paterno . ' ' . $estudiante->matricula->especialidad->docente->apellido_materno,
                'modalidad' => $estudiante->matricula->especialidad->modalidad,
                'ciclo_formativo' => $estudiante->matricula->especialidad->ciclo_formativo,
                'modulo_formativo' => $estudiante->matricula->especialidad->modulo_formativo,
                'periodo_academico' => $estudiante->matricula->especialidad->periodo_academico,
                'periodo_academico' => $estudiante->matricula->especialidad->periodo_academico,
                'hora_semanal' => $estudiante->matricula->especialidad->periodo_academico,
                'seccion' => $estudiante->matricula->especialidad->seccion,
                'turno' => $estudiante->matricula->especialidad->tuno,

            ],
            'unidades_didacticas' => $estudiante->matricula->especialidad->unidadesDidacticas->map(function ($unidad) {
                return [
                    'nombre_unidad' => $unidad->nombre_unidad,
                    'credito_unidad' => $unidad->credito_unidad,
                    'hora' => $unidad->hora,
                    'dia' => $unidad->dia,
                    'fecha_inicio' => $unidad->fecha_inicio,
                    'fecha_final' => $unidad->fecha_final,
                    'fecha_final' => $unidad->fecha_final,
                ];
            })
        ];

        return response()->json($response);
    }

    public function getEstudiantesPorEspecialidad($especialidadId)
    {
        $especialidad = Especialidad::with(['matriculas.estudiante'])
            ->where('programa_estudio', $especialidadId)
            ->first();

        if (!$especialidad) {
            return response()->json(['error' => 'Especialidad no encontrada'], 404);
        }

        $response = [
            'nombre_especialidad' => $especialidad->programa_estudio,
            'turno' => $especialidad->tuno,
            'estudiantes' => $especialidad->matriculas->map(function ($matricula) {
                return [
                    'codigo_matricula' => $matricula->codigo_estudiante_id,
                    'apellidos_nombres' => $matricula->estudiante->apellido_paterno . ' ' . $matricula->estudiante->apellido_materno . ' ' . $matricula->estudiante->nombre,
                    'sexo' => $matricula->estudiante->sexo,
                    'fecha_nacimiento' => $matricula->estudiante->fecha_nacimiento,
                ];
            })
        ];

        return response()->json($response);
    }


    public function getRegistroMatricula()
    {
        $especialidad = Especialidad::with(['matriculas.estudiante'])->first();

        if (!$especialidad) {
            return response()->json(['error' => 'Especialidad no encontrada'], 404);
        }

        $response = [
            'nombre_especialidad' => $especialidad->programa_estudio,
            'estudiantes' => $especialidad->matriculas->map(function ($matricula) {
                return [
                    'dni' => $matricula->estudiante->dni,
                    'apellido_paterno' => $matricula->estudiante->apellido_paterno,
                    'apellidos_materno' => $matricula->estudiante->apellido_paterno,
                    'apellidos_materno' => $matricula->estudiante->nombre,
                    'sexo' => $matricula->estudiante->sexo,
                    'fecha_nacimiento' => $matricula->estudiante->fecha_nacimiento,
                ];
            })
        ];

        return response()->json($response);
    }
}
