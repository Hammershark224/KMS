<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;
use Illuminate\Support\Facades\Auth;
use App\Models\ParentDetail;
use App\Models\StudentApplication;
use App\Models\ResultReference;

class ResultController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'parent') {
            $students = ParentDetail::with('studentApplication.results')->where('user_ID', Auth::user()->user_ID)->get()->first();
            $datas = $students->studentApplication;
        } else {
            $datas = StudentApplication::with('results')->orderByDesc('created_at')->get();
        }
        $examCenters = ResultReference::where('category', 'exam_center')->get();
        return view('ManageStudentResult.resultsList', compact('datas', 'examCenters'));
    }

    public function show()
    {

        return view('ManageStudentResult.resultForm');
    }

    public function slip()
    {
        return view('ManageStudentResult.resultSlip');
    }

    public function create()
    {
        return view('ManageStudentResult.addResultForm');
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

    public function edit($result_id)
    {
        $result = Result::where('result_id', $result_id)->first();
        $student = StudentApplication::where('student_ID', $result->student_id)->first();
        $examCenters = ResultReference::where('category', 'exam_center')->get();
        $courses = ResultReference::where('category', 'course')->get();
        return view('ManageStudentResult.editResultForm', compact('result', 'student', 'examCenters', 'courses'));
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
