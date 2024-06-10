<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\portfoliotitle;
use Illuminate\Http\Request;

class portfoliotitleController extends Controller
{
    //
    public function index()

    {
        $service = portfoliotitle::all();
        $data = ['status' => 200, 'portfolio' => $service];
        return response()->json($data, 200);
    }
}
