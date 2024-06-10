<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\servicetitle;
use Illuminate\Http\Request;

class servicetitleController extends Controller
{
    public function index()

    {
        $service = servicetitle::all();
        $data = ['status' => 200, 'service' => $service];
        return response()->json($data, 200);
    }
}
