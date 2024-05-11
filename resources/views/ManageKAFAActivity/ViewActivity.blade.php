@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.subnav', [
'title' => 'Activity List',
'subtitle' => 'View Activity',
])

@php
$role = Auth::user()->role;
@endphp
<div class="container-fluid py-4">
  <div class="card mb-4">
    <div class="card-header pb-0">
      <p class="font-weight-bold">View Activity</p>
    </div>
    <div class="card-body">
      <form>
        <div class="form-group">
          <label for="activityName">Activity Name</label>
          <input type="text" class="form-control" id="activityName" aria-describedby="activityName"
            value="{{ $activity->activityName }}" disabled>
        </div>
        <div class="form-group">
          <label for="activityDescription">Activity Description</label>
          <textarea class="form-control" id="activityDescription" rows="3"
            disabled>{{ $activity->activityDetails }}</textarea>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="activityDate">Activity Date</label>
              <input type="date" class="form-control" id="activityDate" value="{{ $activity->activityDate }}" disabled>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="activityLocation">Activity Location</label>
              <input type="text" class="form-control" id="activityLocation" value="{{ $activity->activityLocation }}" disabled>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="startTime">Start Time</label>
              <input type="time" class="form-control" id="startTime" value="{{ $activity->startTime }}" disabled>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="EndTime">End Time</label>
              <input type="time" class="form-control" id="endTime" value="{{ $activity->endTime }}" disabled>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="activityCapacity">Activity Capacity</label>
              <input type="number" class="form-control" id="activityCapacity" value="{{ $activity->activityCapacity }}" disabled>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="availableSlots">Available Slots</label>
              <input type="number" class="form-control" id="availableSlots" value="{{ $activity->availableSlot }}" disabled>
            </div>
          </div>
        </div>
        <div class="text-center">
          @if ($role == "k_admin" || $role == "staff")
          <button class="btn btn-primary m-1">View Participants</button>
          @endif
          @if ($role == "parent")
          <button class="btn btn-submit m-1">Join</button>
          @endif
          <a href="{{ route('Activities') }}" class="m-1 btn btn-dark">Back</a>
        </div>
    </div>
    </form>
  </div>
</div>

</div>
@include('layouts.footers.auth.footer')
@endsection