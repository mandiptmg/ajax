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
            'benefit_description' => 'required',
        ];
        // Perform validation
        $validator = validator($request->all(), $rules, [
            'benefit_description.required' => 'Description must be required',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {

            $benefit =  new Benefit;
            $benefit->benefit_description = $request->benefit_description;
            $benefit->save();

            return redirect()->back()->with('success', 'benefit added Successfully');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $systemId, $benefitId)
    {
        $rules = [
            'benefit_description' => 'required',
        ];
        // Perform validation
        $validator = validator($request->all(), $rules, [
            'benefit_description.required' => 'Description must be required',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {

            $benefit = Benefit::where('product_id', $systemId)->findOrFail($benefitId);
            $benefit->benefit_description = $request->benefit_description;
            $benefit->save();

            return redirect()->back()->with('success', 'benefit updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($systemId, $benefitId)
    {
        $benefit = Benefit::where('product_id', $systemId)->findOrFail($benefitId);
        $benefit->delete();
        return redirect()->back()->with('success', 'Benefit Deleted Successfully');
    }
}
