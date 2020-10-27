<?php

namespace App\Http\Controllers\Api\v1;

use JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            // Verificar credenciales
            if (! $token = Auth::guard('api')->attempt($credentials)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'credenciales invalidas'
                ], 400);
            }
        } catch (JWTException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'ocurrio un error al crear el token',
                'error' => $e,
            ], 500);
        }

        return response()->json([
            'token' => $token,
            'status' => 'success',
        ]);
    }

    public function test(Request $request) {
        echo 'test';
    }
}