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
        $parent = ParentDetail::where('parent_ID',auth()->user()->parent->parent_ID)->first();
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

        return view('ManageStudentRegistration.studentManage');
    }

    public function show($id) {
        $students = StudentApplication::find($id);
        // dd($students);
        return view('ManageStudentRegistration.viewForm', ['students'=>$students]);
    }

    public function edit($id) {
        $student = StudentApplication::find($id);
        if($applications->status == 'accepted')
        return view('ManageStudentRegistration.viewForm', ['parents'=>$parents]);
    }
}
