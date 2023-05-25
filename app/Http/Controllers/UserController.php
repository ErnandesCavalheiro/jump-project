<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index()
    {
        try {
            $users = User::paginate(5)->items();

            return response()->json($users, 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Erro interno do servidor',
                'status' => 500
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try{
            $validatedData = $request->validate([
                'name' => 'required|string'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => $e->errors(),
                'message' => 'Preencha todos os dados corretamente',
                'status' => 401
            ], 401);
        }

        try {
            $user = User::create($validatedData);
            return response()->json($user, 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Erro interno do servidor',
                'status' => 500
            ], 500);
        }
    }
}
