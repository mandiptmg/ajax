<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{

    public function __construct()
    
    {
        $this->middleware('permission:view testimonial|create testimonial|update testimonial|delete testimonial', ['only' => ['index','store']]);
        $this->middleware('permission:create testimonial', ['only' => ['create','store']]);
        $this->middleware('permission:update testimonial', ['only' => ['edit','update']]);
        $this->middleware('permission:delete testimonial', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::get();
        return view('admin.testimonial.index', compact('testimonials'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'product_name'=>'required',
            'name' => 'required',
            'occupation' => 'required',
            'description' => 'required',
        ];


        // Check if a hero exists
        if (!$request->testimonial_id) {
            // If hero does not exist, make logo required with image validation rules
            $rules['logo'] = 'required|mimes:jpeg,png,jpg,gif|max:2048';
        } else {
            // If hero exists, make logo nullable
            $rules['logo'] = 'nullable|mimes:jpeg,png,jpg,gif|max:2048';
        }


        // Perform validation
        $validator = validator($request->all(), $rules, [
            'product_name' => 'Product Name must be required',
            'name.required' => 'Name must be required',
            'occupation.required' => 'Occupation must be required',
            'description.required' => 'Description must be required',
            'logo.required' => 'Image must be required',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {

            $testimonial = new Testimonial();
            $testimonial->product_name = $request->product_name;
            $testimonial->name = $request->name;
            $testimonial->occupation = $request->occupation;
            $testimonial->description = strip_tags($request->description);

            if ($request->hasFile('logo')) {

                $imageName = time() . '.' . $request->file('logo')->getClientOriginalExtension();
                $request->file('logo')->move(public_path('uploads/logo'), $imageName);

                $testimonial->image = $imageName; // Assign the image name to the 'image' attribute
            }
            $testimonial->save();

            return response()->json(['status' => 200, 'message' => 'Data stored successfully!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $rules = [
            'product_name'=>'required',
            'name' => 'required',
            'occupation' => 'required',
            'description' => 'required',
        ];


        // Check if a hero exists
        if (!$request->testimonial_id) {
            // If hero does not exist, make logo required with image validation rules
            $rules['logo'] = 'required|mimes:jpeg,png,jpg,gif|max:2048';
        } else {
            // If hero exists, make logo nullable
            $rules['logo'] = 'nullable|mimes:jpeg,png,jpg,gif|max:2048';
        }


        // Perform validation
        $validator = validator($request->all(), $rules, [
            'product_name' => 'Product Name must be required',
            'name.required' => 'Name must be required',
            'occupation.required' => 'Occupation must be required',
            'description.required' => 'Description must be required',
            'logo.required' => 'Image must be required',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {

            $testimonial = Testimonial::findOrFail($id);
            $testimonial->product_name = $request->product_name;
            $testimonial->name = $request->name;
            $testimonial->occupation = $request->occupation;
            $testimonial->description = strip_tags( $request->description);

            if ($request->hasFile('logo')) {

                $imageName = time() . '.' . $request->file('logo')->getClientOriginalExtension();
                $request->file('logo')->move(public_path('uploads/logo'), $imageName);

                $testimonial->image = $imageName; // Assign the image name to the 'image' attribute
            }
            $testimonial->save();

            return response()->json(['status' => 200, 'message' => 'Data stored successfully!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();
        return redirect()->back()->with('success', 'testimonial Deleted Successfully');
        // return response()->json(['status' => 200, 'message' => 'Data deleted successfully!']);
    }
}
