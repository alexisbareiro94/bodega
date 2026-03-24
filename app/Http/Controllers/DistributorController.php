<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDistributorRequest;
use App\Models\Distribuidor;
use Illuminate\Http\JsonResponse;

class DistributorController extends Controller
{
    public function store(StoreDistributorRequest $request): JsonResponse
    {
        $distributor = Distribuidor::create($request->validated());

        return response()->json([
            'success' => true,
            'distributor' => $distributor,
        ]);
    }
}
