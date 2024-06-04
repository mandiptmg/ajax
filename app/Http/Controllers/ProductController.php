<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Feature;
use Illuminate\Http\Request;
use App\Models\Benefit;
use App\Models\Question;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function __construct()

    {
        $this->middleware('permission:view product|create product|update product|delete product', ['only' => ['index', 'store']]);
        $this->middleware('permission:create product', ['only' => ['create', 'store']]);
        $this->middleware('permission:update product', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete product', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        return view('admin.product.create');
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
            'benefit' => 'required',
            'description_benefit.*' => 'nullable|string',
            'question' => 'nullable|array',
            'question.*' => 'nullable|string',
            'answer' => 'nullable|array',
            'answer.*' => 'nullable|string',
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
            'description.required' => 'Description must be required',
            'benefit.required' => 'Benefit must be required',
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
            $product->short_description = strip_tags($request->short_description);
            $product->description = strip_tags($request->description);
            $product->benefit = strip_tags($request->benefit);

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

            Feature::where('product_id', $product->id)->delete();
            if ($request->has('title_feature') && $request->has('description_feature') && $request->hasFile('logo')) {

                foreach ($request->file('logo') as $key => $logo) {
                    // Ensure the corresponding logo and description exist
                    $feature = new Feature();
                    $feature->product_id = $product->id; // Ensure $product is defined and available

                    // Generate a unique file name
                    $featureimg = time() . 'feature.' . $logo->getClientOriginalExtension();

                    // Define the destination path
                    $destinationPath = public_path('uploads/features');

                    // Move the uploaded file
                    $logo->move($destinationPath, $featureimg);

                    // Set feature properties
                    $feature->logo =  $featureimg;
                    $feature->title = $request->title_feature[$key];
                    $feature->description = $request->description_feature[$key];
                    $feature->save();
                }
            }


            //Question and answer
            Question::where('product_id', $product->id)->delete();
            if ($request->has('question')) {
                foreach ($request->question as $key => $question) {
                    $productQuestion = new Question();
                    $productQuestion->product_id = $product->id;
                    $productQuestion->question = $question;
                    $productQuestion->answer = $request->answer[$key];
                    $productQuestion->save();
                }
            }
            if ($request->expectsJson()) {
                return new JsonResponse(['status' => '200', 'message' => 'Product created successfully.'], 200);
            }

            return redirect()->back()->with('success', 'Product created successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::with(['features', 'questionAnswers'])->findOrFail($id);
        return view('admin.product.show', compact('product'));
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
            'benefit' => 'required',
            'logo' => 'nullable|array',
            'logo.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title_feature' => 'nullable|array',
            'title_feature.*' => 'nullable|string|max:255',
            'description_feature' => 'nullable|array',
            'description_feature.*' => 'nullable|string',
            'description_benefit' => 'nullable|array',
            'description_benefit.*' => 'nullable|string',
            'question' => 'nullable|array',
            'question.*' => 'nullable|string',
            'answer' => 'nullable|array',
            'answer.*' => 'nullable|string',
        ];

        // Perform validation
        $validator = validator($request->all(), $rules, [
            'title.required' => 'Title must be required',
            'description.required' => 'Description must be required',
            'benefit.required' => 'Benefit must be required',
            'short_description.required' => 'Short description must be required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {
            $product = Product::with(['features', 'questionAnswers'])->findOrFail($id);


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
                $product->image = implode('|', $uploadedImages);
            }

            $product->title = $request->title;
            $product->short_description = strip_tags($request->short_description);
            $product->description = strip_tags($request->description);
            $product->benefit = strip_tags($request->benefit);

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

            // Handle features
            if ($request->has('title_feature') && $request->has('description_feature')) {
                foreach ($request->title_feature as $key => $titleFeature) {
                    // Check if the feature ID is provided
                    if (isset($request->feature_id[$key])) {
                        // Update existing feature
                        $feature = $product->features->where('id', $request->feature_id[$key])->first();
                        
                    } else {
                        // Create new feature
                        $feature = new Feature();
                        $feature->product_id = $product->id;
                    }
        
                    // Update feature details
                    if (isset($request->logo[$key]) && $request->logo[$key]->isValid()) {
                        $logo = $request->logo[$key];
                        $logoName = time() . '_feature_' . $key . '.' . $logo->getClientOriginalExtension();
                        $logo->move(public_path('uploads/features'), $logoName);
                        $feature->logo = $logoName;
                    }
        
                    $feature->title = $titleFeature;
                    $feature->description = $request->description_feature[$key];
                    $feature->save();
                }
            }
        
            //Question and answer
            Question::where('product_id', $product->id)->delete();
            if ($request->has('question')) {
                foreach ($request->question as $key => $question) {
                    $productQuestion = new Question();
                    $productQuestion->product_id = $product->id;
                    $productQuestion->question = $question;
                    $productQuestion->answer = $request->answer[$key];
                    $productQuestion->save();
                }
            }

            return response()->json(['status' => 200, 'Product update successfully.']);
        }
    }


    public function removeFeature(Request $request)
    {
        $feature = Feature::find($request->id);
        if ($feature) {
            $feature->delete();
            return response()->json(['status' => 'success', 'message' => 'Feature removed successfully.']);
        }
        return response()->json(['status' => 'error', 'message' => 'Feature not found.']);
    }



    public function edit(Request $request, $id)
    {
        $product = Product::with(['features', 'questionAnswers'])->findOrFail($id);
        return view('admin.product.edit', compact('product'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->back()->with('success', 'Product Deleted Successfully');
    }
}
