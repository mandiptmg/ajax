<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AboutController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:create about', ['only' => ['index', 'store']]);
    }

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

        // Define the validation rules
        $rules = [
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required',
            'icon1' => 'required|string|max:255',
            'icon2' => 'required|string|max:255',
            'icon3' => 'required|string|max:255',
            'icon4' => 'required|string|max:255',
            'icon5' => 'required|string|max:255',
            'title_mission' => 'required',
            'description_mission' => 'required',
            'title_vision' => 'required|string|max:255',
            'description_vision' => 'required',
            'why_us' => 'required|string',
            'description_why' => 'required',
            'title_support' => 'required|string|max:255',
            'description_support' => 'required',
            'title_team' => 'required|string|max:255',
            'description_team' => 'required',
            'title_code' => 'required|string|max:255',
            'description_code' => 'required',
            'image1' => 'required|array',
        ];

        // Check if an about exists
        if (!$request->about_id) {
            // If about does not exist, make logo required with image validation rules
            $rules['logo'] = 'required|mimes:jpeg,png,jpg,gif';
        } else {
            // If about exists, make logo nullable
            $rules['logo'] = 'nullable|mimes:jpeg,png,jpg,gif';
        }

        // Perform validation
        $validator = Validator::make($request->all(), $rules, [
            'title.required' => 'Title is required',
            'subtitle.required' => 'Subtitle is required',
            'description.required' => 'Description is required',
            'icon1.required' => 'Icon1 is required',
            'icon2.required' => 'Icon2 is required',
            'icon3.required' => 'Icon3 is required',
            'icon4.required' => 'Icon4 is required',
            'icon5.required' => 'Icon5 is required',
            'title_mission.required' => 'Title mission is required',
            'description_mission.required' => 'Description mission is required',
            'title_vision.required' => 'Title vision is required',
            'description_vision.required' => 'Description vision is required',
            'why_us.required' => 'Why us is required',
            'description_why.required' => 'Description why is required',
            'title_support.required' => 'Title support is required',
            'description_support.required' => 'Description support is required',
            'title_team.required' => 'Title team is required',
            'description_team.required' => 'Description team is required',
            'title_code.required' => 'Title code is required',
            'description_code.required' => 'Description code is required',
            'image1.required' => 'Image1 is required',
            'logo.required' => 'Uploaded file must be an image',
        ]);

        // Handle validation failure
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Validation passed, continue with your logic



        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {
            $uploadedImages = [];
            if ($request->hasFile('image1')) {
                foreach ($request->file('image1') as $file) {
                    $image_name = md5(rand(1000, 10000));
                    $ext = strtolower($file->getClientOriginalExtension());
                    $image_full_name = $image_name . '.' . $ext;
                    $upload_path = public_path('about_images/');
                    $file->move($upload_path, $image_full_name);
                    $uploadedImages[] = $image_full_name;
                }
            }

            $about = $request->about_id ? About::findOrFail($request->about_id) : new About();
            $about->image1 = implode('|', $uploadedImages);
            $about->title = $request->title;
            $about->subtitle = $request->subtitle;
            $about->description = strip_tags($request->description);
            $about->icon1 = $request->icon1;
            $about->icon2 = $request->icon2;
            $about->icon3 = $request->icon3;
            $about->icon4 = $request->icon4;
            $about->icon5 = $request->icon5;
            $about->title_mission = $request->title_mission;
            $about->description_mission = strip_tags($request->description_mission);
            $about->title_vision = $request->title_vision;
            $about->description_vision = strip_tags($request->description_vision);
            $about->why_us = $request->why_us;
            $about->description_why = strip_tags($request->description_why);
            $about->title_support = $request->title_support;
            $about->description_support = strip_tags($request->description_support);
            $about->title_team = $request->title_team;
            $about->description_team = strip_tags($request->description_team);
            $about->title_code = $request->title_code;
            $about->description_code = strip_tags($request->description_code);
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
