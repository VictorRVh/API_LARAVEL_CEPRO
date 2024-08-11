<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Estudiante;

class EstudianteController extends Controller
{
    public function index()
    {
        $Estudiantes = Estudiante::all();

        if ($Estudiantes->isEmpty()) {
            $data = [
                'message' => "No se encontraron datos",
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'Estudiantes' => $Estudiantes,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'codigo_estudiante' => 'required|string|max:6|unique:estudiante,codigo_estudiante',
            'nombre' => 'required|string|max:45',
            'apellido_paterno' => 'required|string|max:45',
            'apellido_materno' => 'required|string|max:45',
            'dni' => 'required|string|max:8|unique:estudiante,dni',
            'sexo' => 'required|string|max:1',
            'celular' => 'required|string|max:9',
            'correo' => 'required|string|email|max:60|unique:estudiante,correo',
            'fecha_nacimiento' => 'required|date'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        $Estudiante = Estudiante::create([
            "codigo_estudiante" => $request->codigo_estudiante,
            "nombre" => $request->nombre,
            "apellido_paterno" => $request->apellido_paterno,
            "apellido_materno" => $request->apellido_materno,
            "sexo" => $request->sexo,
            "dni" => $request->dni,
            "celular" => $request->celular,
            "correo" => $request->correo,
            "fecha_nacimiento" => $request->fecha_nacimiento
        ]);

        if (!$Estudiante) {
            $data = [
                'message' => 'Error al crear el estudiante',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'Estudiante' => $Estudiante,
            'status' => 201
        ];

        return response()->json($data, 201);

    }

    public function findOneEstudent($id)
    {
        $Estudiante = Estudiante::find($id);

        if (!$Estudiante) {
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'Estudiante' => $Estudiante,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $Estudiante = Estudiante::find($id);

        if (!$Estudiante) {
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        $Estudiante->delete();

        $data = [
            'message' => 'Estudiante eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $Estudiante = Estudiante::find($id);

        if (!$Estudiante) {
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'codigo_estudiante' => 'string|max:6|unique:estudiante,codigo_estudiante',
            'nombre' => 'string|max:45',
            'apellido_paterno' => 'string|max:45',
            'apellido_materno' => 'string|max:45',
            'dni' => 'string|max:8|unique:estudiante,dni',
            'sexo' => 'string|max:1',
            'celular' => 'string|max:9',
            'correo' => 'string|email|max:60|unique:estudiante,correo',
            'fecha_nacimiento' => 'date'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        $Estudiante->update($request->all());

        $data = [
            'message' => 'Estudiante actualizado',
            'Estudiante' => $Estudiante,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function updateParcial(Request $request, $id)
    {
        $Estudiante = Estudiante::find($id);

        if (!$Estudiante) {
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'codigo_estudiante' => 'string|max:6|unique:estudiante,codigo_estudiante',
            'nombre' => 'string|max:45',
            'apellido_paterno' => 'string|max:45',
            'apellido_materno' => 'string|max:45',
            'dni' => 'string|max:8|unique:estudiante,dni',
            'sexo' => 'string|max:1',
            'celular' => 'string|max:9',
            'correo' => 'string|email|max:60|unique:estudiante,correo',
            'fecha_nacimiento' => 'date'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        if ($request->has('codigo_estudiante')) {
            $Estudiante->codigo_estudiante = $request->codigo_estudiante;
        }

        if ($request->has('nombre')) {
            $Estudiante->nombre = $request->nombre;
        }

        if ($request->has('apellido_paterno')) {
            $Estudiante->apellido_paterno = $request->apellido_paterno;
        }

        if ($request->has('apellido_materno')) {
            $Estudiante->apellido_materno = $request->apellido_materno;
        }

        if ($request->has('dni')) {
            $Estudiante->dni = $request->dni;
        }
        if ($request->has('sexo')) {
            $Estudiante->sexo = $request->sexo;
        }

        if ($request->has('celular')) {
            $Estudiante->celular = $request->celular;
        }

        if ($request->has('correo')) {
            $Estudiante->correo = $request->correo;
        }

        if ($request->has('fecha_nacimiento')) {
            $Estudiante->fecha_nacimiento = $request->fecha_nacimiento;
        }

        $Estudiante->save();

        $data = [
            'message' => 'Estudiante actualizado parcialmente',
            'Estudiante' => $Estudiante,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

}
