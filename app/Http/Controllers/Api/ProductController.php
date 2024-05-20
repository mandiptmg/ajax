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
        $products = Product::with(['features',  'images', 'benefits', 'questionAnswers'])->get();
        // Map through the products and append the full image URL
        $products = $products->map(function ($product) {
            $product->image_url1 = url('uploads/bg_images/' . $product->bg_image1);
            $product->image_url2 = url('uploads/bg_images2/' . $product->bg_image2);
            // $product->feature_img1 =  url('uploads/logo'. $product->features->logo);
            $product->features = $product->features->map(function ($feature) {
                $feature->logo_url = url('uploads/logo/' . $feature->logo);
                return $feature->makeHidden('logo');
            });
            return $product->makeHidden(['bg_image1', 'bg_image2']);
        });


        $data = [
            'status' => 200,
            'products' => $products
        ];

        return response()->json($data, 200);
        // $product = Product::all();
        // $data = ['status' => 200, 'products' => $product];
        // return response()->json($data, 200);
    }
}
