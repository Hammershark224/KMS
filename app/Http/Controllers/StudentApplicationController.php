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

    public function create() {
        $parents = ParentDetail::all();
        return view('ManageStudentRegistration.applyForm', ['parents'=>$parents]);
    }

    public function store(Request $request) {
        $request->validate([
            'full_name' => 'required|string',
            'ic' => 'required|numeric',
            'gender' => 'required|string',
            'date_birth' => 'required',
            'address' => 'required',
            'status' => 'required',
        ]);

        $student = StudentApplication::create([
            'full_name' => $request->input('full_name'),
            'ic' => $request->input('ic'),
            'gender' => $request->input('gender'),
            'date_birth' => $request->input('date_birth'),
            'address' => $request->input('address'),
            'status' => $request->input('status'),
        ]);

        return view('ManageStudentApplication.studentManage');
    }

    public function show($id) {
        $students = StudentApplication::find($id);
        // dd($students);
        return view('ManageStudentRegistration.viewForm', ['students'=>$students]);
    }

    public function edit($id) {
        $parents = StudentApplication::find($id);
        if($applications->status == 'accepted')
        return view('ManageStudentRegistration.viewForm', ['parents'=>$parents]);
    }
}
