<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Models\Especialidad;
use App\Models\IndicadorLogro;
use App\Models\UnidadDidactica;


class EspecialidadController extends Controller
{
    //
    public function index()
    {
        $specialties = Especialidad::all();

        if ($specialties->isEmpty()) {
            $data = [
                'message' => "No se encontraron datos",
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'especialidades' => $specialties,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_unidad' => 'required|string|max:4|unique:especialidad,id_unidad',
            'programa_estudio' => 'required|string|max:100|unique:especialidad,programa_estudio',
            'ciclo_formativo' => 'string|max:50|nullable',
            'modalidad' => 'string|max:45|nullable',
            'modulo_formativo' => 'string|max:200|nullable',
            'descripcion_especialidad' => 'string|nullable',
            'docente_id' => 'string|max:8|nullable|exists:docente,dni',
            'periodo_academico' => 'string|max:10|nullable',
            'hora_semanal' => 'integer|nullable',
            'seccion' => 'string|max:5|nullable'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        $specialties = Especialidad::create($request->all());

        if (!$specialties) {
            $data = [
                'message' => 'Error al crear la especialidad',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'especialidad' => $specialties,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function findOne($id)
    {
        $specialties = Especialidad::find($id);

        if (!$specialties) {
            $data = [
                'message' => 'Especialidad no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'especialidad' => $specialties,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $specialties = Especialidad::find($id);

        if (!$specialties) {
            $data = [
                'message' => 'Especialidad no encontrada',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        $specialties->delete();

        $data = [
            'message' => 'Especialidad eliminada',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $specialties = Especialidad::find($id);

        if (!$specialties) {
            $data = [
                'message' => 'Especialidad no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'id_unidad' => 'string|max:4|unique:especialidad,id_unidad',
            'programa_estudio' => 'string|max:100|unique:especialidad,programa_estudio',
            'ciclo_formativo' => 'string|max:50|nullable',
            'modalidad' => 'string|max:45|nullable',
            'modulo_formativo' => 'string|max:200|nullable',
            'descripcion_especialidad' => 'string|nullable',
            'docente_id' => 'string|max:8|nullable|exists:docente,dni',
            'periodo_academico' => 'string|max:10|nullable',
            'hora_semanal' => 'integer|nullable',
            'seccion' => 'string|max:5|nullable'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        $specialties->update($request->all());

        $data = [
            'message' => 'Especialidad actualizada',
            'especialidad' => $specialties,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function updateParcial(Request $request, $id)
    {
        $specialties = Especialidad::find($id);

        if (!$specialties) {
            $data = [
                'message' => 'Especialidad no encontrada',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'id_unidad' => 'string|max:4|unique:especialidad,id_unidad',
            'programa_estudio' => 'string|max:100|unique:especialidad,programa_estudio',
            'ciclo_formativo' => 'string|max:50|nullable',
            'modalidad' => 'string|max:45|nullable',
            'modulo_formativo' => 'string|max:200|nullable',
            'descripcion_especialidad' => 'string|nullable',
            'docente_id' => 'string|max:8|nullable|exists:docente,dni',
            'periodo_academico' => 'string|max:10|nullable',
            'hora_semanal' => 'integer|nullable',
            'seccion' => 'string|max:5|nullable'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        if ($request->has('id_unidad')) {
            $specialties->id_unidad = $request->id_unidad;
        }

        if ($request->has('programa_estudio')) {
            $specialties->programa_estudio = $request->programa_estudio;
        }

        if ($request->has('ciclo_formativo')) {
            $specialties->ciclo_formativo = $request->ciclo_formativo;
        }

        if ($request->has('modalidad')) {
            $specialties->modalidad = $request->modalidad;
        }

        if ($request->has('modulo_formativo')) {
            $specialties->modulo_formativo = $request->modulo_formativo;
        }

        if ($request->has('descripcion_especialidad')) {
            $specialties->descripcion_especialidad = $request->descripcion_especialidad;
        }

        if ($request->has('docente_id')) {
            $specialties->docente_id = $request->docente_id;
        }

        if ($request->has('periodo_academico')) {
            $specialties->periodo_academico = $request->periodo_academico;
        }

        if ($request->has('hora_semanal')) {
            $specialties->hora_semanal = $request->hora_semanal;
        }

        if ($request->has('seccion')) {
            $specialties->seccion = $request->seccion;
        }

        $specialties->save();

        $data = [
            'message' => 'Especialidad actualizada parcialmente',
            'especialidad' => $specialties,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
