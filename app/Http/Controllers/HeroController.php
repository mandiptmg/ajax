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
        ];

        // Check if a hero exists
        if (!$request->hero_id) {

            $rules['logo'] = 'required|mimes:jpeg,png,jpg,gif';
        } else {
            $rules['logo'] = 'nullable|mimes:jpeg,png,jpg,gif';
        }

        // Perform validation
        $validator = validator($request->all(), $rules, [
            'title.required' => 'Title is required',
            'description.required' => 'Description is required',
            'logo.required' => 'Uploaded file must be an image',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {

            $hero = $request->hero_id ? Hero::findOrFail($request->hero_id) : new Hero();

            $hero->title = $request->title;
            $hero->description =strip_tags( $request->description);
            // $hero->image = $request->image;
            if ($request->hasFile('logo')) {

                $imageName = time() . '.' . $request->file('logo')->getClientOriginalExtension();
                $request->file('logo')->move(public_path('uploads/logo'), $imageName);

                $hero->image = $imageName; // Assign the image name to the 'image' attribute
            }


            $hero->save();

            return response()->json(['status' => 200, 'message' => 'Data stored successfully!']);
        }
    }
}
