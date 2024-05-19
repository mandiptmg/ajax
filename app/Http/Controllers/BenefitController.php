<?php

namespace App\Http\Controllers;

use App\Models\Benefit;
use Illuminate\Http\Request;

class BenefitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $benefits = Benefit::get();
        return view('admin.product.index', compact('benefits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,)
    {
        $rules = [
            'description' => 'required',
        ];
        // Perform validation
        $validator = validator($request->all(), $rules, [
            'description.required' => 'Description must be required',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {

            $benefit =  new Benefit;
            $benefit->description = $request->description;
            $benefit->save();

            return redirect()->back()->with('success', 'benefit added Successfully');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'description' => 'required',
        ];
        // Perform validation
        $validator = validator($request->all(), $rules, [
            'description.required' => 'Description must be required',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {

            $benefit =   Benefit::findOrFail($id);
            $benefit->description = $request->description;
            $benefit->save();

            return redirect()->back()->with('success', 'benefit updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        $feature = Benefit::findOrFail($id);
        $feature->delete();
        return redirect()->back()->with('success', 'Benefit Deleted Successfully');
    }
}
