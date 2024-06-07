<?php

namespace App\Http\Controllers;

use App\Models\sitesetting;
use Illuminate\Http\Request;

class SitesettingController extends Controller

{


    public function index()

    {

        // $sitesetting = sitesetting::first();
        $sitesetting = sitesetting::get();


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
                'panno' => 'required',

            ],
            [
                'contacttwo.regex' => 'The SMS Contact No. field is invalid.',
                'contanct.required' => 'The Contact field is required.',
                'contanct.regex' => 'The Contact format is invalid.',
                'panno.required' => 'The Pan No. field is required.',

            ]
        );

        if ($request->id) {
            $sitesetting = sitesetting::findorfail($request->id);
        } else {
            $sitesetting = new sitesetting();
        }



        $sitesetting->name = $request->name;

        $sitesetting->subname = $request->subname;

        $sitesetting->panno = $request->panno;

        $sitesetting->accountuser = $request->accountuser;

        $sitesetting->accountpassword = $request->accountpassword;

        $sitesetting->useaccount = $request->useaccount;

        $sitesetting->contanct = $request->contanct;

        $sitesetting->contacttwo = $request->contacttwo;

        $sitesetting->email = $request->email;

        $sitesetting->address = $request->address;

        $sitesetting->description = $request->description;

        $sitesetting->map = $request->map;

        $sitesetting->facebook = $request->facebook;

        $sitesetting->twitter = $request->twitter;

        $sitesetting->youtube = $request->youtube;

        $sitesetting->instagram = $request->instagram;

        $sitesetting->smsapi = $request->smsapi;

        $sitesetting->sendreg = $request->sendreg;

        $sitesetting->sendroute = $request->sendroute;

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
