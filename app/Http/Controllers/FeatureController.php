<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\Product;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $features = Feature::get();
        return view('admin.product.index', compact('features'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $productId)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
        ];


        // Check if a feature exists
        if (!$request->feature_id) {
            // If hero does not exist, make logo required with image validation rules
            $rules['logo'] = 'required|mimes:jpeg,png,jpg,gif|max:2048';
        } else {
            // If hero exists, make logo nullable
            $rules['logo'] = 'nullable|mimes:jpeg,png,jpg,gif|max:2048';
        }


        // Perform validation
        $validator = validator($request->all(), $rules, [
            'title.required' => 'Title must be required',
            'description.required' => 'Description must be required',
            'logo.required' => 'Image must be required',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {

            $product = Product::findOrFail($productId);
            $feature = new Feature();
            $feature->product_id = $request->product_id;
            $feature->title = $request->title;
            $feature->description = $request->description;  

            if ($request->hasFile('logo')) {

                $imageName = time() . '.' . $request->file('logo')->getClientOriginalExtension();
                $request->file('logo')->move(public_path('uploads/logo'), $imageName);

                $feature->logo = $imageName; // Assign the image name to the 'image' attribute
            }
            $product->features()->save($feature);
            return response()->json(['status' => 200, 'message' => 'Feature stored successfully!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Feature $feature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $productId, $featureId)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
        ];


        // Check if a hero exists
        if (!$request->feature_id) {
            // If hero does not exist, make logo required with image validation rules
            $rules['logo'] = 'required|mimes:jpeg,png,jpg,gif|max:2048';
        } else {
            // If hero exists, make logo nullable
            $rules['logo'] = 'nullable|mimes:jpeg,png,jpg,gif|max:2048';
        }


        // Perform validation
        $validator = validator($request->all(), $rules, [
            'title.required' => 'Title must be required',
            'description.required' => 'Description must be required',
            'logo.required' => 'Image must be required',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {
            $feature = Feature::findOrFail($featureId);
            $feature->product_id = $request->product_id;
            $feature->title = $request->title;
            $feature->description = $request->description;

            if ($request->hasFile('logo')) {

                $imageName = time() . '.' . $request->file('logo')->getClientOriginalExtension();
                $request->file('logo')->move(public_path('uploads/logo'), $imageName);

                $feature->image = $imageName; // Assign the image name to the 'image' attribute
            }
            $feature->save();

            return redirect()->back()->with('success', 'feature updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($featureId)
    {
        Feature::findOrFail($featureId)->delete();
        return redirect()->back()->with('success', 'feature Deleted Successfully');
    }
}
