<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\testimonialtitle;
use Illuminate\Http\Request;

class testimonialtitleController extends Controller
{
    public function index()

    {
        $service = testimonialtitle::all();
        $data = ['status' => 200, 'testimonial' => $service];
        return response()->json($data, 200);
    }
}
