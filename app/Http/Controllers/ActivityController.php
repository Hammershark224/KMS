<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\ParentDetail;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentApplication;
use App\Models\Participation;
use Carbon\Carbon;

class ActivityController extends Controller
{
    public function index()
    {
        $currentDate = Carbon::now();
        //display upcoming activities
        $upcomingActivities = Activity::where('activityDate', '>', $currentDate)
                    ->orderByDesc('created_at')
                    ->get();
        //display previous activities
        $previousActivities = Activity::where('activityDate', '<=', $currentDate)
                    ->orderByDesc('activityDate')
                    ->get();
        return view('ManageKAFAActivity.KAFAActivities', compact('upcomingActivities', 'previousActivities'));
    }

    public function create()
    {
        $role = Auth::user()->role;
        if ($role == 'parent') {
            // Parents cannot edit activities, redirect them to the activity index page
            return redirect()->route('Activities')
            ->with('error', 'You do not have permission to create activities');
        }
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
        $activityDate = Carbon::parse($activity->activityDate);
        $currentDate = Carbon::now();

        if ($activityDate->isToday()) {
            $isToday = true;
        } else {
            $isToday = false;
        }
        return view('ManageKAFAActivity.ViewActivity', compact('activity', 'isToday'));
    }

    public function edit($id)
    {
        $role = Auth::user()->role;
        if ($role=='parent') {
        // Parents cannot edit activities, redirect them to the activity index page
             return redirect()->route('Activities')
            ->with('error', 'You do not have permission to edit activities');
        }
        $activity = Activity::find($id);
        $currentDate = Carbon::now();

        if ($activity->activityDate <= $currentDate) {
            // Activity date has reached or passed the current date, cannot edit
            return redirect()->route('Activities')
                ->with('error', 'Cannot edit activity, activity date has already passed');
        }
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
        $activityDate = Carbon::parse($activity->activityDate);
        $currentDate = Carbon::now();

        // check the slot availability is 0 or not
        if ($activity->availableSlot == 0) {
            return redirect()->route('Activities', ['id' => $id])->with('error', 'Activity is full.');
        }
    
        if ($activityDate->isToday() || $activityDate->isPast()) {
            // Activity date has reached or passed, display an error message
            return redirect()->route('Activities')->with('error', 'Activity has already started or ended.');
        }
    
        if (Auth::user()->role == 'parent') {
            $students = ParentDetail::with('studentApplication')->where('user_ID', Auth::user()->user_ID)->first();
            $datas = $students->studentApplication;
            return view('ManageKAFAActivity.AddParticipants', compact('activity', 'datas'));
        }
    }

    //for parent to add their children to the activity
    public function addParticipants(Request $request)
    {
        $selectedParticipants = $request->input('participants', []);
        $activityID = $request->input('activityID');

        if (!$this->maxCapacity($activityID, count($selectedParticipants))) {
            return redirect()->route('view-activity', ['id' => $activityID])->with('error', 'You cannot add more participants than the available slots.');
        }

        $activity = Activity::find($activityID);

        foreach ($selectedParticipants as $studentId) {
            // check if student is already participating in the activity
            if (Participation::where('activityID', $activityID)->where('student_id', $studentId)->exists()) {
                return redirect()->route('view-activity', ['id' => $activityID])->with('error', "The student is already participating in this activity.");
            }
            Participation::create([
                'activityID' => $activityID,
                'student_id' => $studentId,
            ]);
        }

        $activity->decrement('availableSlot', count($selectedParticipants));
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
    
        $now = Carbon::now();
    
        $upcomingActivities = $activities->filter(function ($activity) use ($now) {
            $startDate = Carbon::parse($activity->activityDate);
            return $startDate->gte($now);
        });
    
        $previousActivities = $activities->filter(function ($activity) use ($now) {
            $startDate = Carbon::parse($activity->activityDate);
            return $startDate->lt($now);
        });
    
        $groupedUpcomingActivities = $upcomingActivities->groupBy('activityID')->map(function ($activities) use ($datas) {
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
    
        $groupedPastActivities = $previousActivities->groupBy('activityID')->map(function ($activities) use ($datas) {
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
    
        return view('ManageKAFAActivity.JoinedActivities', compact('groupedUpcomingActivities', 'groupedPastActivities'));
    }

    public function participantsList($id)
    {
        $activity = Activity::find($id);
        if (Auth::user()->role  == 'parent') {
            // Parents cannot edit activities, redirect them to the activity index page
            return redirect()->route('Activities')
            ->with('error', 'You do not have permission to access this page');
        }
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

        $activityDate = Carbon::parse($activity->activityDate);
        $currentDate = Carbon::now();
        $isToday = $activityDate->isToday();

        if ($activityDate->isToday()) {
            $isToday = true;
        } else {
            $isToday = false;
        }

        $students = [];
        foreach ($participations as $participation) {
            $studentId = $participation->student_id;
            $student = StudentApplication::find($studentId);
            $students[] = $student;
        }
        return view('ManageKAFAActivity.viewJoinedActivity', compact('activity', 'students', 'participations', 'isToday'));
    }

    public function unjoin($id)
    {
        $activity = Activity::find($id);
        $activityDate = Carbon::parse($activity->activityDate);
        $currentDate = Carbon::now();
        
        if ($activityDate->isToday() || $activityDate->isPast()) {
            // Activity date has reached or passed, display an error message
            return redirect()->to(route('joined-activity', ['id' => $id]))->with('error', 'Activity has already started or ended.');
        }
    
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