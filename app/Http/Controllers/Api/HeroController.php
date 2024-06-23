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

    /**
     * Show the form for creating a new resource.
     */
//     public function create()
//     {
//         //
//     }

//     /**
//      * Display the specified resource.
//      */
//     public function show(string $id)
//     {
//         return response()->json(['hero' => $id]);
//     }

//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function edit(string $id)
//     {
//         // $hero = $id;
//         // $data = ['status' => 200, 'message' => 'data update sent', 'user' => $hero];
//         // return response()->json($data, 200);

//         // return response()->json(['hero' => $hero]);

//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, string $id)
//     {
//         $hero = hero::find($id);
//         $hero->title = $request->title;
//         $hero->description = $request->description;
//         $hero->image = '1';
//         // $hero->image = $request->image;

//         if ($request->hasFile('logo')) {
//             $imageName = time() . '.' . $request->file('logo')->getClientOriginalExtension();
//             $request->file('logo')->move(public_path('uploads/logo'), $imageName);

//             $hero->image = $imageName; // Assign the image name to the 'image' attribute
//         }
//         $hero->save();


//         return redirect()->back()->with('success', 'Data stored successfully!');
//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(string $id)
//     {
//         $hero = hero::find($id);
//         $hero->delete();
//         $data = ['status' => 200, 'message' => 'Hero deleted successfully'];
//         return response()->json($data, 200);
//     }
// }
