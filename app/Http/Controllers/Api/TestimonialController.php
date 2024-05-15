<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()

    {
        $testimonial = Testimonial::all();
        $data = ['status' => 200, 'services' => $testimonial];
        return response()->json($data, 200);
    }

}
