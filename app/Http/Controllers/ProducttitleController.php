<?php

namespace App\Http\Controllers;

use App\Models\producttitle;
use Illuminate\Http\Request;

class ProducttitleController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:create product', ['only' => ['index', 'store']]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heroes = producttitle::latest()->first();
        return view('admin.product.title', compact('heroes'));
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



        // Perform validation
        $validator = validator($request->all(), $rules, [
            'title.required' => 'Title is required',
            'description.required' => 'Description is required',
            'subtitle.required' =>  'sub title is required'

        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {

            $hero = $request->hero_id ? producttitle::findOrFail($request->hero_id) : new producttitle();

            $hero->title = $request->title;
            $hero->description =strip_tags( $request->description);
    
            $hero->save();

            return response()->json(['status' => 200, 'message' => 'Data stored successfully!']);
        }
    }
}

