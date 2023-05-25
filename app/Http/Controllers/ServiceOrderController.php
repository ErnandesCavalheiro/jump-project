<?php

namespace App\Http\Controllers;

use App\Models\ServiceOrder;
use Exception;
use Illuminate\Http\Request;

class ServiceOrderController extends Controller
{
    public function index()
    {
        try {
            $serviceOrders = ServiceOrder::with('user')->paginate(5)->items();

            return response()->json($serviceOrders, 200);
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
        $validatedData = $request->validate([
            'vehiclePlate' => 'required|string',
            'entryDateTime' => 'required|date',
            'exitDateTime' => 'required|date',
            'priceType' => 'required',
            'price' => 'required',
            'userId' => 'required|exists:users,id'
        ]);

        try {
            $serviceOrder = ServiceOrder::create($validatedData);
            return response()->json($serviceOrder, 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Erro interno do servidor',
                'status' => 500
            ], 500);
        }
    }

    public function searchByPlate($plate)
    {
        try {
            $serviceOrders = ServiceOrder::where('vehiclePlate', $plate)->get();

            return response()->json($serviceOrders, 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Erro interno do servidor',
                'status' => 500
            ], 500);
        }
    }
}
