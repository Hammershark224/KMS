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

    public function update(Request $request, $id)
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
        $activity = Activity::find($id);
        $activity->update($validatedData);
        return redirect()->route('Activities')->with('success', 'Activity updated successfully.');
    }

    public function destroy($id)
    {
        $participations = Participation::where('activityID', $id)->get();
        foreach ($participations as $participation) {
            $participation->delete();
        }

        $activity = Activity::find($id);
        $activity->delete();

        return redirect()->route('Activities')->with('success', 'Activity deleted successfully.');
    }

    public function join($id)
    {
        $activity = Activity::find($id);
        if (Auth::user()->role == 'parent') {
            $students = ParentDetail::with('studentApplication')->where('user_ID', Auth::user()->user_ID)->first();
            $datas = $students->studentApplication;
            return view('ManageKAFAActivity.AddParticipants', compact('activity', 'datas'));
        }
    }

    public function addParticipants(Request $request)
    {
        $selectedParticipants = $request->input('participants', []);
        $activityID = $request->input('activityID');

        if (!$this->maxCapacity($activityID, count($selectedParticipants))) {
            return redirect()->route('view-activity', ['id' => $activityID])->with('error', 'You cannot add more participants than the available slots.');
        }

        $activity = Activity::find($activityID);

        foreach ($selectedParticipants as $studentId) {
            Participation::create([
                'activityID' => $activityID,
                'student_id' => $studentId,
            ]);
        }

        $activity->availableSlot -= count($selectedParticipants);
        $activity->save();

        return redirect()->route('view-activity', ['id' => $activityID])->with('success', 'Added Participants successfully.');
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

    public function participantsList($id)
    {
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

    public function viewJoinedActivity($id)
    {
        $datas = ParentDetail::with('studentApplication.participations.activity')
            ->where('user_ID', Auth::user()->user_ID)
            ->first()
            ->studentApplication;

        $activity = Activity::find($id);

        $participations = $datas->flatMap->participations->where('activityID', $id);
        $studentIds = $participations->pluck('student_id');
        $students = StudentApplication::whereIn('student_id', $studentIds)->get();

        $students = [];
        foreach ($participations as $participation) {
            $studentId = $participation->student_id;
            $student = StudentApplication::find($studentId);
            $students[] = $student;
        }
        return view('ManageKAFAActivity.viewJoinedActivity', compact('activity', 'students', 'participations'));
    }

    public function unjoin($id)
    {
        $activity = Activity::find($id);

        $datas = ParentDetail::with('studentApplication.participations.activity')
            ->where('user_ID', Auth::user()->user_ID)
            ->first()
            ->studentApplication;

        $participations = $datas->flatMap->participations->where('activityID', $id);
        $studentIds = $participations->pluck('student_id');
        $students = StudentApplication::whereIn('student_id', $studentIds)->get();

        $students = [];
        foreach ($participations as $participation) {
            $studentId = $participation->student_id;
            $student = StudentApplication::find($studentId);
            $students[] = $student;
        }
        return view('ManageKAFAActivity.DeleteParticipants', compact('activity', 'students', 'participations'));
    }

    public function DeleteParticipants(Request $request)
    {
        $selectedParticipants = $request->input('participants', []);
        $activityID = $request->input('activityID');

        $activity = Activity::find($activityID);

        foreach ($selectedParticipants as $studentId) {
            $participation = Participation::where('activityID', $activityID)
                ->where('student_id', $studentId)
                ->first();

            if ($participation) {
                $participation->delete();
            }
        }

        $activity->availableSlot += count($selectedParticipants);
        $activity->save();

        return redirect()->route('joined-activities')->with('success', 'Deleted Participants successfully.');
    }

    public function capacityCheck($activityID, $change = 0)
    {
        $activity = Activity::find($activityID);
        $availableSlots = $activity->availableSlot - $change;

        return $availableSlots >= 0;
    }

    public function maxCapacity($activityID, $numParticipants)
    {
        $activity = Activity::find($activityID);
        return $numParticipants <= $activity->availableSlot;
    }
}
