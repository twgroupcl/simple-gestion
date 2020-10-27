<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class Brand extends Controller
{
    public function store(Request $request) {

        dd(JWTAuth::user());

        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
        ]);
      
        if ($validator->fails()) {
          return response()->json($validator->errors(), 400);
        }

        $request['position'] = $request['position'] ?? 0;



    }
}