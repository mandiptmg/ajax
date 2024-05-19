<?php

namespace App\Http\Controllers;

use App\Models\QuestionAnswer;
use Illuminate\Http\Request;

class QuestionAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questionAnswers = QuestionAnswer::get();
        return view('admin.product.index', compact('questionAnswers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
        ]);
        $validator = validator($request->all(), $rules, [
            'question.required' => 'Question must be required',
            'answer.required' => 'Answer must be required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {

            $questionAnswer = new QuestionAnswer();
            $questionAnswer->question = $request->question;
            $questionAnswer->answer = $request->answer;
            $questionAnswer->save();

            return redirect()->back()->with('success', 'Question Answer added Successfully');
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $systemId, $qaId)
    {

        $rules = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
        ]);
        $validator = validator($request->all(), $rules, [
            'question.required' => 'Question must be required',
            'answer.required' => 'Answer must be required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {

            $questionAnswer = QuestionAnswer::where('product_id', $systemId)->findOrFail($qaId);
            $questionAnswer->question = $request->question;
            $questionAnswer->answer = $request->answer;
            $questionAnswer->save();

            return redirect()->back()->with('success', 'Question Answer added Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function  destroy($systemId, $qaId)
    {
        $questionAnswer = QuestionAnswer::where('product_id', $systemId)->findOrFail($qaId);
        $questionAnswer->delete();
        return redirect()->back()->with('success', 'Question Answer Deleted Successfully');
    }
}
