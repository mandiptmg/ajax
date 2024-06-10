<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\producttitle;
use Illuminate\Http\Request;

class ProducttitleController extends Controller
{
    //
    public function index()

    {
        $service = producttitle::all();
        $data = ['status' => 200, 'product' => $service];
        return response()->json($data, 200);
    }
}
