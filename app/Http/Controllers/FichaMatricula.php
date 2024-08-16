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

        $especialidad = $estudiante->matricula->especialidad;
        $unidadesDidacticas = $especialidad->unidadesDidacticas;

        // Obtener el nombre de las unidades didácticas en un solo string
        $nombresUnidades = $unidadesDidacticas->pluck('nombre_unidad')->implode(', ');

        // Obtener la fecha de inicio de la primera unidad y la fecha de fin de la última unidad
        $fechaInicio = $unidadesDidacticas->min('fecha_inicio');
        $fechaFin = $unidadesDidacticas->max('fecha_final');

        // Calcular el total de créditos y las horas por unidad
        $totalCreditos = $unidadesDidacticas->sum('credito_unidad');
        $totalHoras = $unidadesDidacticas->sum('hora');

        // Mapea la información que deseas enviar en la respuesta
        $response = [
            'codigo_estudiante' => $estudiante->codigo_estudiante,
            'nombre_completo' => $estudiante->nombre . ' ' . $estudiante->apellido_paterno . ' ' . $estudiante->apellido_materno,
            'correo' => $estudiante->correo,
            'dni' => $estudiante->dni,
            'especialidad' => [
                'nombre' => $especialidad->programa_estudio,
                'docente' => $especialidad->docente ? $especialidad->docente->nombre . ' ' . $especialidad->docente->apellido_paterno . ' ' . $especialidad->docente->apellido_materno : 'No disponible',
                'modalidad' => $especialidad->modalidad,
                'ciclo_formativo' => $especialidad->ciclo_formativo,
                'modulo_formativo' => $especialidad->modulo_formativo,
                'periodo_academico' => $especialidad->periodo_academico,
                'hora_semanal' => $especialidad->hora_semanal,
                'seccion' => $especialidad->seccion,
                'turno' => $especialidad->turno,
            ],
            'unidades_didacticas' => [
                'nombres_unidades' => $nombresUnidades,
                'fecha_inicio' => $fechaInicio,
                'fecha_fin' => $fechaFin,
                'total_creditos' => $totalCreditos,
                'total_horas' => $totalHoras,
                'detalles' => $unidadesDidacticas->map(function ($unidad) {
                    return [
                        'nombre_unidad' => $unidad->nombre_unidad,
                        'credito_unidad' => $unidad->credito_unidad,
                        'hora' => $unidad->hora,
                        'dia' => $unidad->dia,
                        'fecha_inicio' => $unidad->fecha_inicio,
                        'fecha_final' => $unidad->fecha_final,
                    ];
                })
            ]
        ];

        return response()->json($response);
    }


    public function getEstudiantesPorEspecialidad($especialidadId)
    {
        $especialidad = Especialidad::with(['matriculas.estudiante', 'unidadesDidacticas'])
            ->where('programa_estudio', $especialidadId)
            ->first();

        if (!$especialidad) {
            return response()->json(['error' => 'Especialidad no encontrada'], 404);
        }

        // Calcular el total de unidades didácticas y la suma de créditos
        $totalUnidadesDidacticas = $especialidad->unidadesDidacticas->count();
        $sumaCreditos = $especialidad->unidadesDidacticas->sum('credito_unidad');

        // Obtener las fechas de inicio y fin
        $fechaInicio = $especialidad->unidadesDidacticas->min('fecha_inicio');
        $fechaFin = $especialidad->unidadesDidacticas->max('fecha_final');

        // Concatenar los nombres de las unidades didácticas en un string
        $nombresUnidades = $especialidad->unidadesDidacticas->pluck('nombre_unidad')->implode(', ');

        $response = [
            'nombre_especialidad' => $especialidad->programa_estudio,
            'turno' => $especialidad->turno,
            'seccion' => $especialidad->seccion,
            'total_unidades_didacticas' => $totalUnidadesDidacticas,
            'suma_creditos' => $sumaCreditos,
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin,
            'nombres_unidades_didacticas' => $nombresUnidades,
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




    public function getRegistroMatriculaPorNombre($nombreEspecialidad)
    {
        $especialidad = Especialidad::with(['matriculas.estudiante', 'unidadesDidacticas'])
            ->where('programa_estudio', $nombreEspecialidad)
            ->first();

        if (!$especialidad) {
            return response()->json(['error' => 'Especialidad no encontrada'], 404);
        }

        $unidadesDidacticas = $especialidad->unidadesDidacticas->pluck('nombre_unidad')->implode(', ');

        $response = [
            'nombre_especialidad' => $especialidad->programa_estudio,
            'estudiantes' => $especialidad->matriculas->map(function ($matricula) use ($unidadesDidacticas) {
                return [
                    'codigo_estudiante' => $matricula->estudiante->codigo_estudiante,
                    'dni' => $matricula->estudiante->dni,
                    'apellido_paterno' => $matricula->estudiante->apellido_paterno,
                    'apellido_materno' => $matricula->estudiante->apellido_materno,
                    'nombre' => $matricula->estudiante->nombre,
                    'sexo' => $matricula->estudiante->sexo,
                    'fecha_nacimiento' => $matricula->estudiante->fecha_nacimiento,
                    'unidades_didacticas' => $unidadesDidacticas,
                ];
            })
        ];

        return response()->json($response);
    }
}
