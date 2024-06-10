<?php

namespace App\Http\Controllers;

use App\Models\sitesetting;
use Illuminate\Http\Request;

class SitesettingController extends Controller

{

    public function __construct()
    {
        $this->middleware('permission:create site setting', ['only' => ['index', 'store']]);
    }


    public function index()

    {

        $sitesetting = sitesetting::latest()->first();
        return view('admin.sitesetting.index', compact('sitesetting'));
    }

    public function store(Request $request)

    {

        $request->validate(
            [

                'name' => 'required',
                'email' => 'required|email',
                'contacttwo' => 'nullable|regex:/^98\d{8}$/',
                'contanct' => 'required',
            ],
            [
                'contacttwo.regex' => 'The SMS Contact No. field is invalid.',
                'contanct.required' => 'The Contact field is required.',
                'contanct.regex' => 'The Contact format is invalid.',

            ]
        );

        $sitesetting = $request->sitesetting_id ? sitesetting::findOrFail($request->sitesetting_id) : new sitesetting();


        $sitesetting->name = $request->name;

        $sitesetting->contanct = $request->contanct;

        $sitesetting->contacttwo = $request->contacttwo;

        $sitesetting->email = $request->email;

        $sitesetting->address = $request->address;

        $sitesetting->facebook = $request->facebook;

        $sitesetting->twitter = $request->twitter;

        $sitesetting->youtube = $request->youtube;

        $sitesetting->instagram = $request->instagram;

        $sitesetting->linkedin = $request->linkedin;




        if ($request->hasFile('logo')) {

            $sitesetting->logo = time() . '.' . $request->file('logo')->getClientOriginalExtension();

            $request->file('logo')->move(public_path('uploads/logo'), $sitesetting->logo);
        }

        if ($request->hasFile('favicon')) {

            $sitesetting->favicon = time() . '.' . $request->file('favicon')->getClientOriginalExtension();

            $request->file('favicon')->move(public_path('uploads/favicon'), $sitesetting->favicon);
        }

        return $sitesetting->save() ? redirect()->back()->with(['success' => 'Form Saved Successfully']) : redirect()->back()->with(['failure' => 'Form Submit Failed']);
    }
}
