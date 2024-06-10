<?php

namespace App\Http\Controllers;

use App\Models\portfoliotitle;
use Illuminate\Http\Request;

class PortfoliotitleController extends Controller

{

    public function __construct()
    {
        $this->middleware('permission:create portfolio', ['only' => ['index', 'store']]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heroes = portfoliotitle::latest()->first();
        return view('admin.portfolio.create', compact('heroes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'subtitle' =>'required',
            
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

            $hero = $request->hero_id ? portfoliotitle::findOrFail($request->hero_id) : new portfoliotitle();

            $hero->title = $request->title;
            $hero->subtitle = $request->subtitle;
            $hero->description =strip_tags( $request->description);
    
            $hero->save();

            return response()->json(['status' => 200, 'message' => 'Data stored successfully!']);
        }
    }
}
