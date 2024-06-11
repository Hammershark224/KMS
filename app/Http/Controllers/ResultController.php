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
        // Check if the current user is a parent
        if (Auth::user()->role == 'parent') {
            // Get the parent's student application details, including results
            $students = ParentDetail::with('studentApplication.results')->where('user_ID', Auth::user()->user_ID)->get()->first();
            // Extract the student application data from the parent details
            $datas = $students->studentApplication;
        } else {
            // If not a parent, get all student applications with results, ordered by creation date (newest first)
            // This is for admin/lecturers that can see all student results
            $datas = StudentApplication::with('results')->orderByDesc('created_at')->get();
        }
        // Get all exam centers from the result references table
        $examCenters = ResultReference::where('category', 'exam_center')->get();
        // Return the view with the student application data and exam centers
        return view('ManageStudentResult.resultsList', compact('datas', 'examCenters'));
    }

    public function show($id)
    {
        // Get the result with the specified ID
        $result = Result::where('result_id', $id)->first();

        // Get the student application associated with the result
        $student = StudentApplication::where('student_ID', $result->student_id)->first();

        // Get the exam center associated with the result
        $examCenters = ResultReference::where('code', $result->exam_center_id)->first();

        // Get all subjects from the result references table
        $subjects = ResultReference::where('category', 'course')->get();

        // Return the view with the result, student, exam center, and subjects
        return view('ManageStudentResult.resultForm', compact('result', 'tudent', 'examCenters', 'ubjects'));
    }

    public function slip($id)
    {
        // Get the result with the specified ID
        $result = Result::where('result_id', $id)->first();

        // Get the student application associated with the result
        $student = StudentApplication::where('student_ID', $result->student_id)->first();

        // Get the exam center associated with the result
        $examCenters = ResultReference::where('code', $result->exam_center_id)->first();

        // Get all subjects from the result references table
        $subjects = ResultReference::where('category', 'course')->get();

        // Return the view to display the result slip
        return view('ManageStudentResult.resultSlip', compact('result', 'tudent', 'examCenters', 'ubjects'));
    }

    public function create()
    {
        // Get all exam centers from the result references table
        $examCenters = ResultReference::where('category', 'exam_center')->get();

        // Get all courses from the result references table
        $courses = ResultReference::where('category', 'course')->get();

        // Return the view to add a new result
        return view('ManageStudentResult.addResultForm', compact('examCenters', 'courses'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
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
            // Custom error messages for validation
            'exam_center_id.required' => 'The exam center field is required.',
            'year.required' => 'The year field is required.'
        ]);

        // Find the student application associated with the provided IC number
        $student = StudentApplication::where('ic', $attributes['stu_ic'])->first();

        // If the student is not found, return an error message
        if (!$student) {
            return back()->withInput()->withErrors(['stu_ic' => 'The IC number is not registered in our system.']);
        }

        // Add the student ID to the attributes array
        $attributes['student_id'] = $student->student_ID;

        // Create a new result using the validated attributes
        Result::create($attributes);

        // Redirect to the results list page with a success message
        return redirect()->route('results-list')->with('success', 'Result added successfully.');
    }

    public function edit($result_id)
    {
        // Find the result with the specified ID
        $result = Result::where('result_id', $result_id)->first();

        // Find the student application associated with the result
        $student = StudentApplication::where('student_ID', $result->student_id)->first();

        // Get all exam centers from the result references table
        $examCenters = ResultReference::where('category', 'exam_center')->get();

        // Get all courses from the result references table
        $courses = ResultReference::where('category', 'course')->get();

        // Return the view to edit the result, passing the result, student, exam centers, and courses data
        return view('ManageStudentResult.editResultForm', compact('result', 'student', 'examCenters', 'courses'));
    }

    public function update(Request $request, $result_id)
    {
        // Validate the incoming request data
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

        // Find the result with the specified ID
        $result = Result::where('result_id', $result_id)->first();

        // Update the result with the validated attributes
        $result->update($attributes);

        // Redirect to the results list page with a success message
        return redirect()->route('results-list')->with('success', 'Result updated successfully.');
    }

    public function destroy($result_id)
    {
        // Find the result with the specified ID
        $result = Result::where('result_id', $result_id)->first();

        // Delete the result
        $result->delete();

        // Redirect to the results list page with a success message
        return redirect()->route('results-list')->with('success', 'Result deleted successfully.');
    }
}
