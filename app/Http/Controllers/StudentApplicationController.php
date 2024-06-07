<?php

namespace App\Http\Controllers;

use App\Models\StudentApplication;
use App\Models\ParentDetail;
use Illuminate\Http\Request;

class StudentApplicationController extends Controller
{
    public function indexAdmin() {
        $students = StudentApplication::all();
        return view('ManageStudentRegistration.studentManage', ['students'=>$students]);
    }

    public function index() {
        $parent = ParentDetail::where('parent_ID', auth()->user()->parent->parent_ID)->first();
        //Get the student that connect with parent
        $children = StudentApplication::where('parent_ID', $parent->parent_ID)->get();
        return view('ManageStudentRegistration.studentManage',compact('parent', 'children'));
    }

    public function create() {
        $parents = ParentDetail::all();
        return view('ManageStudentRegistration.applyForm', ['parents'=>$parents]);
    }

    public function store(Request $request) {
        $user = auth()->user();
        $parent = ParentDetail::where('user_ID', $user['user_ID'])->first();
        //validate the input
        $request->validate([
            'full_name' => 'required|string',
            'ic' => 'required|numeric',
            'gender' => 'required|string',
            'date_birth' => 'required|date_format:Y-m-d',
            'status' => 'required',
            'address' => 'required',
        ]);

        // dd($request);

        //store data
        $student = StudentApplication::create([
            'full_name' => $request->input('full_name'),
            'ic' => $request->input('ic'),
            'gender' => $request->input('gender'),
            'date_birth' => $request->input('date_birth'),
            'address' => $request->input('address'),
            'status' => $request->input('status'),
            'parent_ID' => $parent->parent_ID, 
        ]);

        return redirect(route('children.manage'));
    }

    public function show($id) {
        $student = StudentApplication::find($id);
        // dd($student);
        return view('ManageStudentRegistration.viewForm', compact('student'));
    }

    public function edit($id) {
        $student = StudentApplication::find($id);
        // dd($student);
        if($student->status == 'accepted') {
            return redirect(route('student.manage'))->with('error', 'accepted application cannot be edited');
        } else {
            $status = [
                'status' => 'reviewed'
            ];
        }
        $student->update($status);
        return view('ManageStudentRegistration.editForm', compact('student'));
    }

    public function update(Request $request, $id) {
        $student = StudentApplication::find($id);
        // dd($student);

        //Update data
        $student -> update($request->all());
        return redirect(route('student.manage'));
    }

    public function destroy($id) {
        $student = StudentApplication::find($id);
        // dd($student);
        
        //Delete data
        $student->results()->delete();
        //Delete data connect with student
        $student->participations()->delete();
        $student->participations()->delete();
        $student->delete();

        $role = auth()->user()->role;

        // Redirect based on the role
        if ($role === 'k_admin') {
            return redirect(route('student.manage')); // Redirect to the admin view
        } elseif ($role === 'parent') {
            return redirect(route('children.manage'));
        }
    }
}