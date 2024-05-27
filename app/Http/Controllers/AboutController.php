<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abouts = About::latest()->first();
        return view('admin.about.index', compact('abouts'));
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

        // Check if a about exists
        if (!$request->about_id) {
            // If about does not exist, make logo required with image validation rules
            $rules['logo'] = 'required|mimes:jpeg,png,jpg,gif|max:2048';
        } else {
            // If about exists, make logo nullable
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

            $about = $request->about_id ? About::findOrFail($request->about_id) : new About();

            $about->title = $request->title;
            $about->description = strip_tags($request->description);
            // $about->image = $request->image;
            if ($request->hasFile('logo')) {

                $imageName = time() . '.' . $request->file('logo')->getClientOriginalExtension();
                $request->file('logo')->move(public_path('uploads/logo'), $imageName);

                $about->image = $imageName; // Assign the image name to the 'image' attribute
            }


            $about->save();

            return response()->json(['status' => 200, 'message' => 'Data stored successfully!']);
        }
    }
}
