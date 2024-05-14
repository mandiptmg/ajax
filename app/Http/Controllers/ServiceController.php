<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::get();
        return view('admin.services.index',compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'icon' => 'required',
        ];


        // Perform validation
        $validator = validator($request->all(), $rules, [
            'title.required' => 'Title is required',
            'description.required' => 'Description is required',
            'icon.required' => 'icon is required',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {

            $service = $request->service_id ? Service::findOrFail($request->service_id) : new Service();

            $service->title = $request->title;
            $service->description = $request->description;
            $service->icon = $request->icon;
            $service->save();

            return response()->json(['status' => 200, 'message' => 'Data stored successfully!']);
        }
    }
}
