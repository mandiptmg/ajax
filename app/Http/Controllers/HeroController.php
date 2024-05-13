<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        return view('admin.hero.index');
    }

    /**
     * Display a listing of the resource.
     */


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = validator($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Ensure uploaded file is an image
        ], [
            'title.required' => 'Title is required',
            'description.required' => 'Description is required',
            'logo.image' => 'Uploaded file must be an image',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {
            $hero = new hero();
            $hero->title = $request->title;
            $hero->description = $request->description;
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(['hero' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $hero = $id;
        // $data = ['status' => 200, 'message' => 'data update sent', 'user' => $hero];
        // return response()->json($data, 200);

        // return response()->json(['hero' => $hero]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hero = hero::find($id);
        $hero->title = $request->title;
        $hero->description = $request->description;
        // $hero->image = $request->image;

        if ($request->hasFile('logo')) {
            $imageName = time() . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(public_path('uploads/logo'), $imageName);

            $hero->image = $imageName; // Assign the image name to the 'image' attribute
        }
        $hero->save();


        return response()->json(['status' => 200, 'message' => 'Data stored successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hero = Hero::find($id);
        $hero->delete();
        $data = ['status' => 200, 'message' => 'Hero deleted successfully'];
        return response()->json($data, 200);
    }
}
