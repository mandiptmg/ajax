<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Policy;
use Illuminate\Http\Request;

class PolicyController extends Controller
{

    public function index()
    {
        $policy = Policy::all();

        $data = [
            'status' => 200,
            'policy' => $policy
        ];

        return response()->json($data, 200);
    }
}
