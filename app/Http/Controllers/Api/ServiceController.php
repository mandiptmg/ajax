<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function index()

    {
        $service = Service::all();
        $data = ['status' => 200, 'services' => $service];
        return response()->json($data, 200);
    }
}
