<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hero = Hero::all();

        // Map through the hero and append the full image URL
        $heroes = $hero->map(function($hero) {
            if ($hero->image) {
                $hero->image_url = url('uploads/logo/' . $hero->image);
            } else {
                $hero->image_url = null;
            }
        
            if ($hero->video) {
                $hero->video_url = url('uploads/video/' . $hero->video);
            } else {
                $hero->video_url = null;
            }
        
            // Remove the 'image' and 'video' attributes from the visible properties
            return $hero->makeHidden(['image', 'video']);
        });
        

        $data = [
            'status' => 200,
            'hero' => $hero
        ];

        return response()->json($data, 200);
    }
}

  