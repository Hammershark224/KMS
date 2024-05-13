@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.subnav', [
'title' => 'ParticipantsList',
'subtitle' => 'List of Participants',
])

@php
$role = Auth::user()->role;
@endphp
<div class="container-fluid py-4">
  <div class="card mb-2">
    <div class="card-header pb-0">
      <p class="font-weight-bold">List of Participants</p>
    </div>
    <div class="card-body">
      <strong><span class="activityName fs-6 text">Activity Name: </span>
        <span class="fs-6 text">{{ $activity->activityName }}</span></strong>
      @php
      $index = 1;
      @endphp
      <form>
        @if ($participants != null)
        @foreach ($participants as $participant)
        @php
        // Access the student ID from the participation
        $studentId = $participant->student_id;
        
        // Use the student ID to fetch the corresponding student details
        $student = \App\Models\StudentApplication::find($studentId);
        // Check if the student exists
        if ($student) {
            // Access student properties
            $studentName = $student->full_name;
            $studentIc = $student->ic;
        } else {
            // Handle case where student is not found
            $studentName = "Unknown";
            $studentIc = "Unknown";
        }
        @endphp
        <input type="hidden" name="activityID" value="{{ $activity->activityID }}">
        <div class="form-check mt-3">
          <label for="defaultCheck{{$index++}}">
            {{ $studentName }} [{{ $studentIc }}]
          </label>
        </div>
        @endforeach
        @else
        <p class="text-center">No data available in table</p>
        @endif
        <div class="text-center">
            <a href="{{route('Activities')}}" class="btn btn-back btn-dark m-1">Back</a>
          </div>
      </form>
    </div>
  </div>
</div>

@include('layouts.footers.auth.footer')
@endsection
@push('scripts')
