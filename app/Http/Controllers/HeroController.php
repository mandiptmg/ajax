<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class HeroController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:create hero', ['only' => ['index', 'store']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heroes = Hero::latest()->first();
        return view('admin.hero.index', compact('heroes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'url' => 'nullable|url',
        ];

        // Check if a hero exists
        if (!$request->hero_id) {
            $rules['logo'] = 'required|mimes:jpeg,png,jpg,gif|max:2048'; // Max size 2MB
            $rules['video'] = 'nullable|mimes:mp4,avi,mov,wmv';
        } else {
            $rules['logo'] = 'nullable|mimes:jpeg,png,jpg,gif|max:2048'; // Max size 2MB
            $rules['video'] = 'nullable|mimes:mp4,avi,mov,wmv';
        }

        $validator = validator($request->all(), $rules, [
            'title.required' => 'Title is required',
            'description.required' => 'Description is required',
            'logo.required' => 'Uploaded file must be an image',
            'logo.mimes' => 'Logo must be a file of type: jpeg, png, jpg, gif',
            'logo.max' => 'Logo may not be greater than 2MB',
            'url.url' => 'URL must be a valid URL',
            'video.mimes' => 'Video must be a file of type: mp4, avi, mov, wmv',
            'video.max' => 'Video may not be greater than 10MB',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {

            $hero = $request->hero_id ? Hero::findOrFail($request->hero_id) : new Hero();

            $hero->title = $request->title;
            $hero->description = strip_tags($request->description);

            // Handle logo upload
            if ($request->hasFile('logo')) {
                $imageName = time() . '.' . $request->file('logo')->getClientOriginalExtension();
                $request->file('logo')->move(public_path('uploads/logo'), $imageName);
                $hero->image = $imageName; // Assign the image name to the 'image' attribute
            }


            // Handle video upload
            if ($request->hasFile('video')) {
                $videoName = time() . '.' . $request->file('video')->getClientOriginalExtension();
                $request->file('video')->move(public_path('uploads/video'), $videoName);
                $hero->video = $videoName; // Assign the video name to the 'video' attribute
            }


            // Handle URL
            if ($request->has('url')) {
                $hero->url = $request->url; // Assign the URL to the 'url' attribute
            }


            $hero->save();

            return response()->json(['status' => 200, 'message' => 'Data stored successfully!']);
        }
    }
}
