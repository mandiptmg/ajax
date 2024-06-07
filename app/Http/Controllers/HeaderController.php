<?php

namespace App\Http\Controllers;

use App\Models\Header;
use Illuminate\Http\Request;

class HeaderController extends Controller
{

    public function __construct()
    
    {
        $this->middleware('permission:view header|create header|update header|delete header', ['only' => ['index','store']]);
        $this->middleware('permission:create header', ['only' => ['create','store']]);
        $this->middleware('permission:update header', ['only' => ['edit','update']]);
        $this->middleware('permission:delete header', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $headers = Header::get();
        return view('admin.header.index',compact('headers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'icon' => 'required',
        ];


        // Perform validation
        $validator = validator($request->all(), $rules, [
            'title.required' => 'Title is required',
            'icon.required' => 'icon is required',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {

            $header = $request->header_id ? Header::findOrFail($request->header_id) : new Header();

            $header->title = $request->title;
            $header->icon = $request->icon;
            $header->save();

            return response()->json(['status' => 200, 'message' => 'Data stored successfully!']);
        }
    }

    public function edit($id)
    {
        $headers = Header::findOrFail($id);
        return view('admin.header.edit', compact('headers'));
    }
    
    public function update(Request $request, String $id)
    {

        $rules = [
            'title' => 'required',
            'icon' => 'required',
        ];


        // Perform validation
        $validator = validator($request->all(), $rules, [
            'title.required' => 'Title is required',
            'icon.required' => 'icon is required',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {

            $header =  Header::findOrFail($id); 
            $header->title = $request->title;
            $header->icon = $request->icon;
            $header->save();

            return response()->json(['status' => 200, 'message' => 'Data updated successfully!']);
        }
    } 
    public function destroy($id){
        $header = Header::findOrFail($id);
        $header->delete();
        return redirect()->back()->with('success', 'Service Deleted Successfully');
        // return response()->json(['status' => 200, 'message' => 'Data deleted successfully!']);
    }
}

