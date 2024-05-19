<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function index()

        {
            $product = Product::all();
            $data = ['status' => 200, 'products' => $product];
            return response()->json($data, 200);
        }
    
    }

