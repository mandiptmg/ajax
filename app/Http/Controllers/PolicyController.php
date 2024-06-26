<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PolicyController extends Controller
{
    public function __construct()
    {
        // Middleware permissions
        $this->middleware('permission:view policy|create policy|update policy|delete policy', ['only' => ['index', 'store']]);
        $this->middleware('permission:create policy', ['only' => ['create', 'store']]);
        $this->middleware('permission:update policy', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete policy', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $policies = Policy::latest()->get(); // Use get() to fetch all policies

        return view('admin.policy.index', compact('policies'));
    }

    private function sanitizeHtml($content)
    {
        // Strip out any unwanted tags but keep basic formatting tags
        $allowedTags = '<p><a><strong><em><ul><ol><li><br><code>';
        return strip_tags($content, $allowedTags);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ], [
            'title.required' => 'Title is required',
            'description.required' => 'Description is required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        }
        $cleanedContent = $this->sanitizeHtml($request->description);


        $policy = new Policy();
        $policy->title = $request->title;
        $policy->description = $cleanedContent;
        $policy->save();

        return response()->json(['status' => 200, 'message' => 'Data stored successfully!']);
    }

    public function show($id)
    {
        $policy = Policy::findOrFail($id);

        return view('admin.policy.show', compact('policy'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ], [
            'title.required' => 'Title is required',
            'description.required' => 'Description is required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        }

        $policy = Policy::findOrFail($id);
        $policy->title = $request->title;
        $policy->description = $request->description;
        $policy->save();

        return response()->json(['status' => 200, 'message' => 'Data updated successfully!']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $policy = Policy::findOrFail($id);
        $policy->delete();

        return redirect()->back()->with('success', 'Policy Deleted Successfully');
    }
}
