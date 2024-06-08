<?php

namespace App\Http\Controllers\api;

use App\Models\Header;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
public function index()
{
    $header = Header::all();
    $data = [
        'status' => 200,
        'header' => $header
    ];

    return response()->json($data, 200);
}
}
