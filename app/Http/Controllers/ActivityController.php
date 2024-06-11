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
     // Method to display the list of upcoming and previous activities
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

    // Method to show the create activity form
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

    // Method to store a new activity
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
        // Set available slots equal to activity capacity
        $validatedData['availableSlot'] = $validatedData['activityCapacity'];

        // Create a new activity record
        $activity = Activity::create($validatedData);

        return redirect()->route('Activities')->with('success', 'Activity added successfully.');
    }

    // Method to show a specific activity's details
    public function show($id)
    {
        $activity = Activity::find($id);
        $activityDate = Carbon::parse($activity->activityDate);
        $currentDate = Carbon::now();
        $isPast = $activityDate->isPast();

        // Check if the activity is today
        if ($activityDate->isToday()) {
            $isToday = true;
        } else {
            $isToday = false;
        }
        return view('ManageKAFAActivity.ViewActivity', compact('activity', 'isToday', 'isPast'));
    }

    // Method to show the edit activity form
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

        // Check if the activity date has reached or passed the current date
        if ($activity->activityDate <= $currentDate) {
            // Activity date has reached or passed the current date, cannot edit
            return redirect()->route('Activities')
                ->with('error', 'Cannot edit activity, activity date has already passed');
        }
        return view('ManageKAFAActivity.EditActivity', compact('activity'));
    }

    // Method to update an existing activity
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
        // Set available slots equal to activity capacity
        $validatedData['availableSlot'] = $validatedData['activityCapacity'];

        // Find the existing activity and update it
        $activity = Activity::find($id);
        $activity->update($validatedData);
        return redirect()->route('Activities')->with('success', 'Activity updated successfully.');
    }

    // Method to delete an existing activity
    public function destroy($id)
    {
        // Find and delete all participations for the activity
        $participations = Participation::where('activityID', $id)->get();
        foreach ($participations as $participation) {
            $participation->delete();
        }

        // Find and delete the activity
        $activity = Activity::find($id);
        $activity->delete();

        return redirect()->route('Activities')->with('success', 'Activity deleted successfully.');
    }

    // Method to join an activity
    public function join($id)
    {
        $activity = Activity::find($id);
        $activityDate = Carbon::parse($activity->activityDate);
        $currentDate = Carbon::now();

        // check the slot availability is 0 or not
        if ($activity->availableSlot == 0) {
            return redirect()->route('Activities', ['id' => $id])->with('error', 'Activity is full.');
        }
        // Check if the activity date has reached or passed
        if ($activityDate->isToday() || $activityDate->isPast()) {
            // Activity date has reached or passed, display an error message
            return redirect()->route('Activities')->with('error', 'Activity has already started or ended.');
        }
        // If the user is a parent, display the form to add participants
        if (Auth::user()->role == 'parent') {
            $students = ParentDetail::with('studentApplication')->where('user_ID', Auth::user()->user_ID)->first();
            $datas = $students->studentApplication;
            return view('ManageKAFAActivity.AddParticipants', compact('activity', 'datas'));
        }
    }

    //for parent to add their children to the activity
    public function addParticipants(Request $request)
    {
        // Get selected participants and activity ID from the request
        $selectedParticipants = $request->input('participants', []);
        $activityID = $request->input('activityID');

        // Check if the selected participants exceed the available slots
        if (!$this->maxCapacity($activityID, count($selectedParticipants))) {
            return redirect()->route('view-activity', ['id' => $activityID])->with('error', 'You cannot add more participants than the available slots.');
        }

        $activity = Activity::find($activityID);

        // Add each selected participant to the activity
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
        // Decrease the available slots by the number of added participants
        $activity->decrement('availableSlot', count($selectedParticipants));
        $activity->save();

        return redirect()->route('view-activity', ['id' => $activityID])->with('success', 'Added Participants successfully.');
    }

    // Method to display joined activities
    public function JoinedActivities()
    {
        // Get the parent details and their children's participations
        $datas = ParentDetail::with('studentApplication.participations.activity')
            ->where('user_ID', Auth::user()->user_ID)
            ->first()
            ->studentApplication;
    
        // Get unique activity IDs for the participations
        $activityIDs = $datas->flatMap->participations->pluck('activityID')->unique();
        $activities = Activity::whereIn('activityID', $activityIDs)->get();
    
        $now = Carbon::now();
        // Filter upcoming and past activities
        $upcomingActivities = $activities->filter(function ($activity) use ($now) {
            $startDate = Carbon::parse($activity->activityDate);
            return $startDate->gte($now);
        });
    
        $previousActivities = $activities->filter(function ($activity) use ($now) {
            $startDate = Carbon::parse($activity->activityDate);
            return $startDate->lt($now);
        });

        // Group upcoming activities by activity ID and map children to each activity
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
    
         // Group past activities by activity ID and map children to each activity
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

     // Method to display the list of participants for a specific activity
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

    // Method to view the joined activity details
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
        $isPast = $activityDate->isPast();

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
        return view('ManageKAFAActivity.viewJoinedActivity', compact('activity', 'students', 'participations', 'isToday', 'isPast'));
    }

    // Method to unjoin an activity
    public function unjoin($id)
    {
        // Find the activity by its ID
        $activity = Activity::find($id);
        $activityDate = Carbon::parse($activity->activityDate); // Parse the activity date
        $currentDate = Carbon::now(); // Get the current date and time
        
        // Check if the activity date is today or has already passed
        if ($activityDate->isToday() || $activityDate->isPast()) {
            // Activity date has reached or passed, display an error message
            return redirect()->to(route('joined-activity', ['id' => $id]))->with('error', 'Activity has already started or ended.');
        }
    
        // Get the parent details and their children's participations
        $datas = ParentDetail::with('studentApplication.participations.activity')
            ->where('user_ID', Auth::user()->user_ID)
            ->first()
            ->studentApplication;
         // Get participations for the specific activity
        $participations = $datas->flatMap->participations->where('activityID', $id);
        // Get student IDs of the participants
        $studentIds = $participations->pluck('student_id');
        // Retrieve student applications based on the student IDs
        $students = StudentApplication::whereIn('student_id', $studentIds)->get();

        // Initialize an empty array for students
        $students = [];
        // Populate the array with student details
        foreach ($participations as $participation) {
            $studentId = $participation->student_id;
            $student = StudentApplication::find($studentId);
            $students[] = $student;
        }
        return view('ManageKAFAActivity.DeleteParticipants', compact('activity', 'students', 'participations'));
    }

    // Method to delete participants from an activity
    public function DeleteParticipants(Request $request)
    {
        // Get selected participants and activity ID from the request
        $selectedParticipants = $request->input('participants', []);
        $activityID = $request->input('activityID');

        $activity = Activity::find($activityID);
        
        // Delete each selected participant from the activity
        foreach ($selectedParticipants as $studentId) {
            $participation = Participation::where('activityID', $activityID)
                ->where('student_id', $studentId)
                ->first();

            if ($participation) {
                $participation->delete();
            }
        }
        // Increase the available slots by the number of deleted participants
        $activity->availableSlot += count($selectedParticipants);
        $activity->save();

        return redirect()->route('joined-activities')->with('success', 'Deleted Participants successfully.');
    }

    // Method to check if there are enough available slots for a given activity and change
    public function capacityCheck($activityID, $change = 0)
    {
        $activity = Activity::find($activityID);
        $availableSlots = $activity->availableSlot - $change;

        return $availableSlots >= 0;
    }

     // Method to check if the number of participants does not exceed the activity capacity
    public function maxCapacity($activityID, $numParticipants)
    {
        $activity = Activity::find($activityID);
        return $numParticipants <= $activity->availableSlot;
    }
}