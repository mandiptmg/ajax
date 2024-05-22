<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Feature;
use Illuminate\Http\Request;
use App\Models\Benefit;
use App\Models\Question;

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
            'logo' => 'nullable|array',
            'logo.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title_feature' => 'nullable|array',
            'title_feature.*' => 'nullable|string|max:255',
            'description_feature' => 'nullable|array',
            'description_feature.*' => 'nullable|string',
            'description_benefit' => 'nullable|array',
            'description_benefit.*' => 'nullable|string',


        ];



        // Check if a hero exists
        if (!$request->product_id) {
            // If hero does not exist, make logo required with image validation rules
            $rules['bg_image1'] = 'required|mimes:jpeg,png,jpg,gif';
            $rules['bg_image2'] = 'required|mimes:jpeg,png,jpg,gif';
            $rules['image'] = 'required|array';
        } else {
            // If hero exists, make logo nullable
            $rules['bg_image1'] = 'nullable|mimes:jpeg,png,jpg,gif';
            $rules['bg_image2'] = 'nullable|mimes:jpeg,png,jpg,gif';
            $rules['image'] = 'nullable|array';
        }


        // Perform validation
        $validator = validator($request->all(), $rules, [
            'title.required' => 'Title must be required',
            'question.required' => 'Question must be required',
            'description.required' => 'Description must be required',
            'short_description.required' => 'Short description must be required',
            'bg_image1' => ' Background Image must be required',
            'bg_image2' => 'Background Image must be required',
            'image' => 'Image must be required',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {

            $uploadedImages = [];
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $file) {
                    $image_name = md5(rand(1000, 10000));
                    $ext = strtolower($file->getClientOriginalExtension());
                    $image_full_name = $image_name . '.' . $ext;
                    $upload_path = public_path('product_images/');
                    $file->move($upload_path, $image_full_name);
                    $uploadedImages[] = $image_full_name;
                }
            }
            $product = new Product();
            $product->image = implode('|', $uploadedImages);
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

            //feature
            if ($request->has('title_feature') && $request->has('description_feature') && $request->hasFile('logo')) {
                $titles = $request->input('title_feature');
                $descriptions = $request->input('description_feature');
                $logos = $request->file('logo');

                foreach ($titles as $key => $title) {
                    // Ensure the corresponding logo and description exist
                    if (isset($logos[$key]) && isset($descriptions[$key])) {
                        $feature = new Feature();
                        $feature->product_id = $product->id;
                        $feature->logo = $logos[$key]->store('logos', 'public');
                        $feature->title = $title;
                        $feature->description = $descriptions[$key];
                        $feature->save();
                    }
                }
            }

            //benefit
            if ($request->has('description_benefit')) {
                $descriptions = $request->input('description_benefit');

                foreach ($descriptions as $key => $description) {
                    // Ensure the corresponding logo and description exist
                    if (isset($descriptions[$key])) {
                        $benefit = new Benefit();
                        $benefit->product_id = $product->id;
                        $benefit->description = $descriptions[$key];
                        $benefit->save();
                    }
                }
            }

            //Question and answer
            if ($request->has('question') && $request->has('answer')) {
                $questions = $request->input('question');
                $answers = $request->input('answer');
                foreach ($questions as $key => $question) {
                    // Ensure the corresponding logo and description exist
                    if (isset($descriptions[$key])) {
                        $qa = new Question();
                        $qa->product_id = $product->id;
                        $qa->question = $questions[$key];
                        $qa->answer = $answers[$key];
                        $qa->save();
                    }
                }
            }


            return response()->json(['status' => 200, 'message' => 'Product stored successfully!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
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
            $rules['image'] = 'required|mimes:jpeg,png,jpg,gif|max:2048';
        } else {
            // If hero exists, make logo nullable
            $rules['bg_image1'] = 'nullable|mimes:jpeg,png,jpg,gif|max:2048';
            $rules['bg_image2'] = 'nullable|mimes:jpeg,png,jpg,gif|max:2048';
            $rules['image'] = 'nullable|mimes:jpeg,png,jpg,gif|max:2048';
        }


        // Perform validation
        $validator = validator($request->all(), $rules, [
            'title.required' => 'Title must be required',
            'question.required' => 'Question must be required',
            'description.required' => 'Description must be required',
            'short_description.required' => 'Short description must be required',
            'bg_image1' => ' Background Image must be required',
            'bg_image2' => 'Background Image must be required',
            'image' => 'Image must be required',

        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {
            $uploadedImages = [];
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $file) {
                    $image_name = md5(rand(1000, 10000));
                    $ext = strtolower($file->getClientOriginalExtension());
                    $image_full_name = $image_name . '.' . $ext;
                    $upload_path = public_path('product_images/');
                    $file->move($upload_path, $image_full_name);
                    $uploadedImages[] = 'product_images/' . $image_full_name;
                }
            }
            $product = Product::findOrFail($id);
            $product->image = implode('|', $uploadedImages);
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
