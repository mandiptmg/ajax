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
        $heroes = Hero::latest()->first();
        return view('admin.hero.index', compact('heroes'));
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
        $rules = [
            'title' => 'required',
            'description' => 'required',
        ];

        // Check if a hero exists
        if (!$request->hero_id) {
            // If hero does not exist, make logo required with image validation rules
            $rules['logo'] = 'required|mimes:jpeg,png,jpg,gif|max:2048';
        } else {
            // If hero exists, make logo nullable
            $rules['logo'] = 'nullable|mimes:jpeg,png,jpg,gif|max:2048';
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
}

    // public function edit($id)
    // {
    //     $heroes = Hero::findOrFail($id);
    //     return view('admin.hero.edit', compact('heroes'));
    // }

    // public function update(Request $request, $id)
    // {

    //     $validator = validator($request->all(), [
    //         'title' => 'required',
    //         'description' => 'required',
    //         'logo' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048', // Ensure uploaded file is an image
    //     ], [
    //         'title.required' => 'Title is required',
    //         'description.required' => 'Description is required',
    //         'logo.required' => 'Uploaded file must be an image',
    //     ]);


    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 400,
    //             'errors' => $validator->errors()
    //         ]);
    //     } else {
    //         $hero = Hero::findOrFail($id);
    //         $hero->title = $request->title;
    //         $hero->description = $request->description;
    //         // $hero->image = $request->image;
    //         if (isset($request->image)) {
    //             if ($request->hasFile('logo')) {

    //                 $imageName = time() . '.' . $request->file('logo')->getClientOriginalExtension();
    //                 $request->file('logo')->move(public_path('uploads/logo'), $imageName);

    //                 $hero->image = $imageName; // Assign the image name to the 'image' attribute
    //             }
    //         }

    //         $hero->save();

    //         return response()->json(['status' => 200, 'message' => 'Data stored successfully!']);
    //     }
    // }


//     public function destroy(string $id)
//     {
//         $hero = Hero::find($id);
//         $hero->delete();
//         $data = ['status' => 200, 'message' => 'Hero deleted successfully'];
//         return response()->json($data, 200);
//     }
// }
