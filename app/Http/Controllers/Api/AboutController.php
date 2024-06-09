<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about = About::all();

        // Map through the about and append the full image URL
        $about = $about->map(function($about) {
            $about->image_url = url('uploads/logo/' . $about->image);
            if ($about->image1) {
                $about->image_urls = collect(explode('|', $about->image1))
                    ->map(function ($image) {
                        return url('about_images/' . $image);
                    });
            }

            return $about->makeHidden(['image','image1']);

            
        });

        $data = [
            'status' => 200,
            'about' => $about
        ];

        return response()->json($data, 200);
    }
}
