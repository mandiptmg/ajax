<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\sitesetting;
use Illuminate\Http\Request;

class SitesettingController extends Controller
{
    public function index()
    {
        $sitesetting = sitesetting::all();

        $sitesetting = $sitesetting->map(function($sitesetting) {
            $sitesetting->logo_url = url('uploads/logo/' . $sitesetting->logo);
            $sitesetting->favicon_url = url('uploads/favicon/' . $sitesetting->favicon);
            return $sitesetting->makeHidden(['logo','favicon']);


            
        });
        

        $data = [
            'status' => 200,
            'sitesetting' => $sitesetting
        ];

        return response()->json($data, 200);
    }
}
