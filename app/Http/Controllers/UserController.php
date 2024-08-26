<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginFormRequest;


class UserController extends Controller
{

    public function index()
    {
        $user = User::all();

        return response()->json([
            'user' => $user,
            'status' => 200
        ], 200);
    }

    public function store(Request $request)
    {
        // Validación de los datos de entrada
        $validator = Validator::make($request->all(), [
            'dni' => 'required|string|max:8|unique:user',
            'password' => 'required|string|min:8'
        ], [
            'dni.required' => 'El campo DNI es obligatorio.',
            'dni.string' => 'El campo DNI debe ser un texto.',
            'dni.max' => 'El campo DNI no debe tener más de :max caracteres.',
            'dni.unique' => 'El DNI ya está registrado.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.string' => 'El campo contraseña debe ser un texto.',
            'password.min' => 'El campo contraseña debe tener al menos :min caracteres.'
        ]);

        // Verificar si la validación falla
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        // Crear un nuevo usuario
        $user = User::create([
            'dni' => $request->input('dni'),
            'password' => Hash::make($request->input('password')) // Encriptar la contraseña
        ]);

        // Verificar si el usuario fue creado correctamente
        if (!$user) {
            return response()->json([
                'message' => 'Error al crear el usuario',
                'status' => 500
            ], 500);
        }

        // Respuesta exitosa
        return response()->json([
            'user' => $user,
            'status' => 201
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'dni' => 'sometimes|required|string|max:8|unique:user,dni,' . $id,
            'password' => 'sometimes|required|string|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $user->update([
            'dni' => $request->input('dni', $user->dni),
            'password' => $request->has('password') ? Hash::make($request->input('password')) : $user->password
        ]);

        return response()->json([
            'user' => $user,
            'status' => 200
        ], 200);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (!$user->delete()) {
            return response()->json([
                'message' => 'Error al eliminar el usuario',
                'status' => 500
            ], 500);
        }

        return response()->json([
            'message' => 'Usuario eliminado correctamente',
            'status' => 200
        ], 200);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dni' => 'required|string|max:8',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        // Validar las credenciales del usuario
        if (Auth::attempt(['dni' => $request->dni, 'password' => $request->password])) {
            $user = Auth::user();

            // Aquí puedes generar un token de autenticación si usas API tokens
            // $token = $user->createToken('YourAppName')->plainTextToken;

            return response()->json([
                'user' => $user,
                // 'token' => $token // Si usas tokens
            ], 200);
        } else {
            return response()->json([
                'errors' => ['login' => ['Las credenciales proporcionadas son incorrectas.']]
            ], 401); // Código de estado 401 para errores de autenticación
        }
    }
}
