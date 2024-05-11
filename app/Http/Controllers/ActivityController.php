<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;

class ActivityController extends Controller
{
    public function index()
    {
        $datas = Activity::orderByDesc('created_at')->get();
        return view('ManageKAFAActivity.KAFAActivities', compact('datas'));
    }
    public function create()
    {
        return view('ManageKAFAActivity.CreateActivity');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'activityName' => 'required',
            'activityDetails' => 'required',
            'activityLocation' => 'required',
            'activityDate' => 'required',
            'startTime' => 'required',
            'endTime' => 'required',
            'activityCapacity' => 'required',
        ]);

        $validatedData['availableSlot'] = $validatedData['activityCapacity'];

        $activity = Activity::create($validatedData);

        return redirect()->route('Activities')->with('success', 'Activity added successfully.');
    }
    public function show()
    {
        return view('ManageKAFAActivity.ViewActivity');
    }
    public function edit()
    {
        return view('ManageKAFAActivity.EditActivity');
    }
    public function destroy($id){
        $activity = Activity::find($id);
        $activity->delete();

        return redirect()->route('Activities')->with('success', 'Activity deleted successfully.');
    }
}
