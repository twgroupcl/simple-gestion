<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Commune;
use Illuminate\Http\Request;
use App\Http\Resources\CommuneResource;
use App\Http\Controllers\Api\Controller;

class CommuneController extends Controller
{
    public function index(Request $request)
    {
        $communes = Commune::all();

        return response()->json([
            'status' => 'success',
            'data' => CommuneResource::collection($communes),
        ], 200);
    }
}
