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

    public function show($id)
    {
        $result = Result::where('result_id', $id)->first();
        $student = StudentApplication::where('student_ID', $result->student_id)->first();
        $examCenters = ResultReference::where('code', $result->exam_center_id)->first();
        $subjects = ResultReference::where('category', 'course')->get();
        return view('ManageStudentResult.resultForm', compact('result', 'student', 'examCenters', 'subjects'));
    }

    public function slip($id)
    {
        $result = Result::where('result_id', $id)->first();
        $student = StudentApplication::where('student_ID', $result->student_id)->first();
        $examCenters = ResultReference::where('code', $result->exam_center_id)->first();
        $subjects = ResultReference::where('category', 'course')->get();
        return view('ManageStudentResult.resultSlip', compact('result', 'student', 'examCenters', 'subjects'));
    }

    public function create()
    {
        $examCenters = ResultReference::where('category', 'exam_center')->get();
        $courses = ResultReference::where('category', 'course')->get();
        return view('ManageStudentResult.addResultForm', compact('examCenters', 'courses'));
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'stu_ic' => 'required',
            'exam_center_id' => 'required',
            'year' => 'required',
            'grade_solat' => 'required',
            'grade_pchi' => 'required',
            'grade_quran' => 'required',
            'grade_jawi' => 'required',
            'grade_sirah' => 'required',
            'grade_syariah' => 'required',
            'grade_adab' => 'required',
            'grade_lughah' => 'required',
        ], [
            'exam_center_id.required' => 'The exam center field is required.',
            'year.required' => 'The year field is required.'
        ]);

        $student = StudentApplication::where('ic', $attributes['stu_ic'])->first();

        if (!$student) {
            return back()->withInput()->withErrors(['stu_ic' => 'The IC number is not registered in our system.']);
        }

        $attributes['student_id'] = $student->student_ID;

        Result::create($attributes);

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

    public function update(Request $request, $result_id)
    {
        $attributes = $request->validate([
            'exam_center_id' => 'required',
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

        $result = Result::where('result_id', $result_id)->first();
        $result->update($attributes);

        return redirect()->route('results-list')->with('success', 'Result updated successfully.');
    }

    public function destroy($result_id)
    {
        $result = Result::where('result_id', $result_id)->first();
        $result->delete();

        return redirect()->route('results-list')->with('success', 'Result deleted successfully.');
    }
}
