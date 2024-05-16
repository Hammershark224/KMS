<?php

namespace App\Http\Controllers;

use App\Models\StaffDetail;
use App\Models\User;
use Illuminate\Http\Request;

class StaffProfileController extends Controller
{
    public function index() {
        $staffs = StaffDetail::all();
        return view('ManageStaffProfile.staffManage', compact('staffs'));
    }

    public function create() {
        return view('ManageStaffProfile.addStaffForm');
    }

    public function store(Request $request) {
        //validate the input
        $request->validate([
            'full_name' => 'required|string',
            'ic' => 'required|numeric',
            'phone_num' => 'required|numeric',
            'email' => 'required',
            'password' => 'required',
            'gender' => 'required',
            'identity' => 'required',
            'program' => 'required',
        ]);

        // dd($request);

        //store data
        $user = User::create($request->all());
        // dd($user);
        $staff = $user->staff->create();

        return redirect(route('staff.manage'));
    }

    public function show($id) {
        $student = StudentApplication::find($id);
        // dd($student);
        return view('ManageStudentRegistration.viewForm', compact('student'));
    }

    public function edit($id) {
        $student = StudentApplication::find($id);
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
        $student -> update($request->all());
        return redirect(route('student.manage'));
    }

    public function destroy($id) {
        $student = StudentApplication::find($id);
        $student -> delete();
        $role = auth()->user()->role;

        // Redirect based on the role
        if ($role === 'admin') {
            return redirect()->route('student.manage'); // Redirect to the admin view
        } elseif ($role === 'parent') {
            return redirect()->route('children.manage');
        }
    }
}
