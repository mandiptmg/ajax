<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questionAnswers = Question::get();
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

            $questionAnswer = new Question();
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

            $questionAnswer = Question::where('product_id', $systemId)->findOrFail($qaId);
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
        $question = Question::where('product_id', $systemId)->findOrFail($qaId);
        $question->delete();
        return redirect()->back()->with('success', 'Question Answer Deleted Successfully');
    }
}
