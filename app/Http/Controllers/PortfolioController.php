<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{

    public function __construct()
    
    {
        $this->middleware('permission:view portfolio|create portfolio|update portfolio|delete portfolio', ['only' => ['index','store']]);
        $this->middleware('permission:create portfolio', ['only' => ['create','store']]);
        $this->middleware('permission:update portfolio', ['only' => ['edit','update']]);
        $this->middleware('permission:delete portfolio', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portfolios = Portfolio::get();
        return view('admin.portfolio.index', compact('portfolios'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'url' => 'required',
        ];


        // Check if a hero exists
        if (!$request->portfolio_id) {
            // If hero does not exist, make logo required with image validation rules
            $rules['logo'] = 'required|mimes:jpeg,png,jpg,gif|max:2048';
        } else {
            // If hero exists, make logo nullable
            $rules['logo'] = 'nullable|mimes:jpeg,png,jpg,gif|max:2048';
        }


        // Perform validation
        $validator = validator($request->all(), $rules, [
            'url.required' => 'Url address must be required',
            'logo.required' => 'Image must be required',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {

            $portfolio = new portfolio();
            $portfolio->url = $request->url;
            if ($request->hasFile('logo')) {

                $imageName = time() . '.' . $request->file('logo')->getClientOriginalExtension();
                $request->file('logo')->move(public_path('uploads/logo'), $imageName);

                $portfolio->image = $imageName; // Assign the image name to the 'image' attribute
            }
            $portfolio->save();

            return response()->json(['status' => 200, 'message' => 'Data stored successfully!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Portfolio $portfolio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $rules = [
            'url' => 'required',
        ];


        // Check if a hero exists
        if (!$request->portfolio_id) {
            // If hero does not exist, make logo required with image validation rules
            $rules['logo'] = 'required|mimes:jpeg,png,jpg,gif|max:2048';
        } else {
            // If hero exists, make logo nullable
            $rules['logo'] = 'nullable|mimes:jpeg,png,jpg,gif|max:2048';
        }


        // Perform validation
        $validator = validator($request->all(), $rules, [
            'url.required' => 'Url address must be required',
            'logo.required' => 'Image must be required',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {
            $portfolio =Portfolio::findOrFail($request->portfolio_id);
            $portfolio->url = $request->url;
            if ($request->hasFile('logo')) {

                $imageName = time() . '.' . $request->file('logo')->getClientOriginalExtension();
                $request->file('logo')->move(public_path('uploads/logo'), $imageName);

                $portfolio->image = $imageName; // Assign the image name to the 'image' attribute
            }
            $portfolio->save();

            return response()->json(['status' => 200, 'message' => 'Data update successfully!']);
        }
    } 
    public function destroy($id){
        $service = Portfolio::findOrFail($id);
        $service->delete();
        return redirect()->back()->with('success', 'Portfolio Deleted Successfully');
        // return response()->json(['status' => 200, 'message' => 'Data deleted successfully!']);
    }
}
