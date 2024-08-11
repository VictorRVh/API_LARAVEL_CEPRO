<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Matricula;

use Illuminate\Support\Facades\Validator;



class MatriculaController extends Controller
{
    public function index()
    {
        $matriculas = Matricula::all();

        if ($matriculas->isEmpty()) {
            $data = [
                'message' => "No se encontraron datos",
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'matriculas' => $matriculas,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'codigo_estudiante_id' => 'required|string|max:6|exists:estudiante,codigo_estudiante|unique:matricula',
            'turno' => 'required|string|max:1',
            'condicion' => 'required|string|max:1',
            'programa_estudio_id' => 'required|string|max:100|exists:especialidad,programa_estudio',
            'numero_recibo' => 'required|string|max:10|unique:matricula',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $matricula = Matricula::create($request->all());

        if (!$matricula) {
            $data = [
                'message' => 'Error al crear la matrícula',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'matricula' => $matricula,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function findOne($id)
    {
        $matricula = Matricula::find($id);

        if (!$matricula) {
            $data = [
                'message' => 'Matrícula no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'matricula' => $matricula,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $matricula = Matricula::find($id);

        if (!$matricula) {
            $data = [
                'message' => 'Matrícula no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'codigo_estudiante_id' => 'string|max:6|exists:estudiante,codigo_estudiante|unique:matricula',
            'turno' => 'string|max:1',
            'condicion' => 'string|max:1',
            'programa_estudio_id' => 'string|max:100|exists:especialidad,programa_estudio',
            'numero_recibo' => 'string|max:10|unique:matricula',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $matricula->update($request->all());

        $data = [
            'message' => 'Matrícula actualizada',
            'matricula' => $matricula,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
    public function updateParcial(Request $request, $id)
    {
        $matricula = Matricula::find($id);

        if (!$matricula) {
            $data = [
                'message' => 'Matrícula no encontrada',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'codigo_estudiante_id' => 'string|max:6|exists:estudiante,codigo_estudiante|unique:matricula',
            'turno' => 'string|max:1',
            'condicion' => 'string|max:1',
            'programa_estudio_id' => 'string|max:100|exists:especialidad,programa_estudio',
            'numero_recibo' => 'string|max:10|unique:matricula',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        if ($request->has('codigo_estudiante_id')) {
            $matricula->codigo_estudiante_id = $request->codigo_estudiante_id;
        }

        if ($request->has('turno')) {
            $matricula->turno = $request->turno;
        }

        if ($request->has('condicion')) {
            $matricula->condicion = $request->condicion;
        }

        if ($request->has('programa_estudio_id')) {
            $matricula->programa_estudio_id = $request->programa_estudio_id;
        }

        if ($request->has('numero_recibo')) {
            $matricula->numero_recibo = $request->numero_recibo;
        }

        $matricula->save();

        $data = [
            'message' => 'Matrícula actualizada parcialmente',
            'matricula' => $matricula,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
    public function destroy($id)
    {
        $matricula = Matricula::find($id);

        if (!$matricula) {
            $data = [
                'message' => 'Matrícula no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $matricula->delete();

        $data = [
            'message' => 'Matrícula eliminada',
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
