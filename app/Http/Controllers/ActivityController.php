<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\ParentDetail;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentApplication;
use App\Models\Participation;

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
    public function show($id)
    {
        $activity = Activity::find($id);
        return view('ManageKAFAActivity.ViewActivity', compact('activity'));
    }
    public function edit($id)
    {
        $activity = Activity::find($id);
        return view('ManageKAFAActivity.EditActivity', compact('activity'));
    }
    public function update(Request $request, $id){

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
        $activity = Activity::find($id);
        $activity->update($validatedData);
        return redirect()->route('Activities')->with('success', 'Activity updated successfully.');
    }
    public function destroy($id){
        $activity = Activity::find($id);
        $activity->delete();

        return redirect()->route('Activities')->with('success', 'Activity deleted successfully.');
    }
    public function join($id){
        $activity = Activity::find($id);
        if (Auth::user()->role == 'parent') {
            $students = ParentDetail::with('studentApplication')->where('user_ID', Auth::user()->user_ID)->get()->first();
            $datas = $students->studentApplication;
        return view('ManageKAFAActivity.AddParticipants', compact('activity','datas'));
    }
}
public function addParticipants(Request $request)
{
    // Get the selected participants from the request
    $selectedParticipants = $request->input('participants', []);

    $activityID = $request->input('activityID');
    // Iterate over the selected participants and add them to the database
    foreach ($selectedParticipants as $studentId) {
        // Create a new participation record
        Participation::create([
            'activityID' => $activityID,
            'student_id' => $studentId,
        ]);
    }
    // Optionally, you can redirect back or return a response
    return redirect()->route('Activities')->with('success', 'Added Participants successfully.');
}
public function JoinedActivities()
{
    $datas = ParentDetail::with('studentApplication.participations.activity')
        ->where('user_ID', Auth::user()->user_ID)
        ->first()
        ->studentApplication;

    $activityIDs = $datas->flatMap->participations->pluck('activityID')->unique();
    $activities = Activity::whereIn('activityID', $activityIDs)->get();


    $groupedActivities = $activities->groupBy('activityID')->map(function ($activities) use ($datas) {
        $children = [];
        foreach ($activities as $activity) {
            $participations = $datas->flatMap->participations->where('activityID', $activity->activityID);
            foreach ($participations as $participation) {
             
                $studentId = $participation->student_id;
                $child = StudentApplication::find($studentId)->full_name;
                
                $children[] = $child;
            }
        }
        return ['activity' => $activities->first(), 'children' => $children];
    });

    return view('ManageKAFAActivity.JoinedActivities', compact('groupedActivities'));
}
public function participantsList($id){
    $activity = Activity::find($id);
    $participants = Participation::with('students.participants')->where('activityID', $id)->get();
    $students = [];
    foreach ($participants as $participant) {
        $studentId = $participant->student_id;
        $student = StudentApplication::find($studentId);
        $students[] = $student;
    }

    return view('ManageKAFAActivity.ListofParticipants', compact('activity', 'participants', 'students'));
}
}