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

        // Map through the testimonial and append the full image URL
        $testimonial = $testimonial->map(function($testimonial) {
            $testimonial->image_url = url('uploads/logo/' . $testimonial->image);
            return $testimonial->makeHidden(['image']);
            
        });

        $data = [
            'status' => 200,
            'testimonial' => $testimonial
        ];

        return response()->json($data, 200);
    }

}
