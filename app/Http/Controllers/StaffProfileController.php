<?php

namespace App\Http\Controllers;

use App\Models\StaffDetail;
use App\Models\User;
use Illuminate\Http\Request;

class StaffProfileController extends Controller
{
    public function index() {
        //Get all staffs
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
        
        //store staff data
        $staff = $user->staff()->create([
            'identity' => $request->input('identity'),
            'program' => $request->input('program'),
        ]);
        // dd($staff);
        return redirect(route('staff.manage'));
    }

    public function show($id) {
        //Retrieve selected staff
        $staff = StaffDetail::find($id);
        // dd($staff);
        return view('ManageStaffProfile.viewStaffForm', compact('staff'));
    }

    public function edit($id) {
        $staff = StaffDetail::find($id);
        // dd($staff);
        return view('ManageStaffProfile.editStaffForm', compact('staff'));
    }

    public function update(Request $request, $id) {
        $staff = StaffDetail::find($id);
        $staff->update($request->all());
        // dd($staff);

        //update info
        $staff->user->update($request->all());
        // dd($staff->user);
        return redirect(route('staff.manage'));
    }

    public function destroy($id) {
        $staff = StaffDetail::find($id);

        //delete staff info
        $staff->delete();

        //delete user info connect with staff
        $staff->user->delete();
        return redirect(route('staff.manage'));
    }
}
