<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Str;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::get();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'short_description' => 'required',

        ];



        // Check if a hero exists
        if (!$request->product_id) {
            // If hero does not exist, make logo required with image validation rules
            $rules['bg_image1'] = 'required|mimes:jpeg,png,jpg,gif|max:2048';
            $rules['bg_image2'] = 'required|mimes:jpeg,png,jpg,gif|max:2048';
        } else {
            // If hero exists, make logo nullable
            $rules['bg_image1'] = 'nullable|mimes:jpeg,png,jpg,gif|max:2048';
            $rules['bg_image2'] = 'nullable|mimes:jpeg,png,jpg,gif|max:2048';
        }


        // Perform validation
        $validator = validator($request->all(), $rules, [
            'title.required' => 'Title must be required',
            'question.required' => 'Question must be required',
            'description.required' => 'Description must be required',
            'short_description.required' => 'Short description must be required',
            'bg_image1' => ' Background Image must be required',
            'bg_image2' => 'Background Image must be required',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {

            $product = new Product();
            $product->title = $request->title;

            $product->short_description = $request->short_description;
            $product->description = $request->description;

            if ($request->hasFile('bg_image1')) {
                $bgImage1Name = time() . 'bg1.' . $request->file('bg_image1')->getClientOriginalExtension();
                $request->file('bg_image1')->move(public_path('uploads/bg_images'), $bgImage1Name);
                $product->bg_image1 = $bgImage1Name;
            }

            if ($request->hasFile('bg_image2')) {
                $bgImage2Name = time() . 'bg2.' . $request->file('bg_image2')->getClientOriginalExtension();
                $request->file('bg_image2')->move(public_path('uploads/bg_images2'), $bgImage2Name);
                $product->bg_image2 = $bgImage2Name;
            }

            


            $product->save();

            return response()->json(['status' => 200, 'message' => 'Product stored successfully!']);


            // return redirect()->back()->with('success', 'Product added Successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        return response()->json($id->load('features'), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'short_description' => 'required',

        ];


        // Check if a hero exists
        if (!$request->product_id) {
            // If hero does not exist, make logo required with image validation rules
            $rules['bg_image1'] = 'required|mimes:jpeg,png,jpg,gif|max:2048';
            $rules['bg_image2'] = 'required|mimes:jpeg,png,jpg,gif|max:2048';
        } else {
            // If hero exists, make logo nullable
            $rules['bg_image1'] = 'nullable|mimes:jpeg,png,jpg,gif|max:2048';
            $rules['bg_image2'] = 'nullable|mimes:jpeg,png,jpg,gif|max:2048';
        }


        // Perform validation
        $validator = validator($request->all(), $rules, [
            'title.required' => 'Title must be required',
            'question.required' => 'Question must be required',
            'description.required' => 'Description must be required',
            'short_description.required' => 'Short description must be required',
            'bg_image1' => ' Background Image must be required',
            'bg_image2' => 'Background Image must be required',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {

            $product = Product::findOrFail($id);
            $product->title = $request->title;
            $product->short_description = $request->short_description;
            $product->description = $request->description;

            if ($request->hasFile('bg_image1')) {
                $bgImage1Name = time() . 'bg1.' . $request->file('bg_image1')->getClientOriginalExtension();
                $request->file('bg_image1')->move(public_path('uploads/bg_images'), $bgImage1Name);
                $product->bg_image1 = $bgImage1Name;
            }

            if ($request->hasFile('bg_image2')) {
                $bgImage2Name = time() . 'bg2.' . $request->file('bg_image2')->getClientOriginalExtension();
                $request->file('bg_image2')->move(public_path('uploads/bg_images2'), $bgImage2Name);
                $product->bg_image2 = $bgImage2Name;
            }

            $product->save();

            return response()->json(['status' => 200, 'message' => 'Product update successfully!']);

        }
    }


    /**
     * Remove the specified resource from storage.
     */  public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->back()->with('success', 'Product Deleted Successfully');
        // return response()->json(['status' => 200, 'message' => 'Data deleted successfully!']);
    }
}
