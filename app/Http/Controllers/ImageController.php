<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = Image::get();
        return view('admin.product.index', compact('images'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!$request->image_id) {
            // If hero does not exist, make image required with image validation rules
            $rules['image'] = 'required|mimes:jpeg,png,jpg,gif|max:2048';
        } else {
            // If hero exists, make image nullable
            $rules['image'] = 'nullable|mimes:jpeg,png,jpg,gif|max:2048';
        }

        // Perform validation
        $validator = validator($request->all(), $rules, [
            'image.required' => 'Uploaded file must be an image',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {

            $image = new Image();
            if ($request->hasFile('image')) {

                $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move(public_path('uploads/image'), $imageName);

                $image->image = $imageName; // Assign the image name to the 'image' attribute
            }


            $image->save();
            return redirect()->back()->with('success', 'Image added Successfully');
        }
    }

    public function update(Request $request,  $systemId, $imageId)
    {
        if (!$request->image_id) {
            // If hero does not exist, make image required with image validation rules
            $rules['image'] = 'required|mimes:jpeg,png,jpg,gif|max:2048';
        } else {
            // If hero exists, make image nullable
            $rules['image'] = 'nullable|mimes:jpeg,png,jpg,gif|max:2048';
        }

        // Perform validation
        $validator = validator($request->all(), $rules, [
            'image.required' => 'Uploaded file must be an image',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {
            $image = Image::where('product_id', $systemId)->findOrFail($imageId);
            if ($request->hasFile('image')) {

                $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move(public_path('uploads/image'), $imageName);

                $image->image = $imageName; // Assign the image name to the 'image' attribute
            }
        }

        $image->save();


        return redirect()->back()->with('success', 'Image Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($systemId, $imageId)
    {
        $image = Image::where('product_id', $systemId)->findOrFail($imageId);
        $image->delete();
        return redirect()->back()->with('success', 'Image Deleted Successfully');
    }
}
