<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;

class ResultController extends Controller
{
    public function index()
    {
        return view('ManageStudentResult.resultsList');
    }

    public function show()
    {

        return view('ManageStudentResult.viewResult');
    }

    public function slip()
    {
        return view('ManageStudentResult.viewResultSlip');
    }

    public function create()
    {
        return view('ManageStudentResult.addResult');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'stu_ic' => 'required',
            'exam_center' => 'required',
            'year' => 'required',
            'grade_solat' => 'required',
            'grade_pchi' => 'required',
            'grade_quran' => 'required',
            'grade_jawi' => 'required',
            'grade_sirah' => 'required',
            'grade_syariah' => 'required',
            'grade_adab' => 'required',
            'grade_lughah' => 'required',
        ]);

        $result = Result::create($attributes);

        return redirect()->route('results-list')->with('success', 'Result added successfully.');
    }

    public function edit($stu_ic)
    {
        $result = Result::where('stu_ic', $stu_ic)->first();
        return view('ManageStudentResult.editResult', compact('result'));
    }

    public function update(Request $request, $id)
    {
        $attributes = $request->validate([
            'stu_ic' => 'required',
            'exam_center' => 'required',
            'year' => 'required',
            'grade_solat' => 'required',
            'grade_pchi' => 'required',
            'grade_quran' => 'required',
            'grade_jawi' => 'required',
            'grade_sirah' => 'required',
            'grade_syariah' => 'required',
            'grade_adab' => 'required',
            'grade_lughah' => 'required',
        ]);

        $result = Result::find($id);
        $result->update($attributes);

        return redirect()->route('results-list')->with('success', 'Result updated successfully.');
    }

    public function destroy($id)
    {
        $result = Result::find($id);
        $result->delete();

        return redirect()->route('results-list')->with('success', 'Result deleted successfully.');
    }
}
