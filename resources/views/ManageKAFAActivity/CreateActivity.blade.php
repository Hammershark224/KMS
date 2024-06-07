@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.subnav', [
'title' => 'Activity List',
'subtitle' => 'Create Activity',
])
@php
$role = Auth::user()->role;
@endphp

<div class="container-fluid py-4">
  <div class="card mb-4">
    <div class="card-header pb-0">
      <p class="font-weight-bold">Create Activity</p>
    </div>
    <div class="card-body">
      <form action="{{ route('create-activity.perform') }}" method="post">
      @csrf
        <div class="form-group">
          <label for="activityName">Activity Name</label>
          <input type="text" class="form-control" id="activityName" name="activityName" aria-describedby="activityName"
            placeholder="Enter the activity name">
        </div>
        <div class="form-group">
          <label for="activityDescription">Activity Description</label>
          <textarea class="form-control" id="activityDescription"  name="activityDetails" rows="3" placeholder="Enter the activity description"></textarea>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="activityDate">Activity Date</label>
              <input type="date" class="form-control" id="activityDate" name="activityDate" min="<?php echo date('Y-m-d');?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="activityLocation">Activity Location</label>
              <input type="text" class="form-control" id="activityLocation" name="activityLocation" placeholder="Enter activity location">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="startTime">Start Time</label>
              <input type="time" class="form-control" id="startTime" name="startTime">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="endTime">End Time</label>
              <input type="time" class="form-control" id="endTime" name="endTime">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="activityCapacity">Activity Capacity</label>
          <input type="number" class="form-control" id="activityCapacity" name="activityCapacity" placeholder="Enter Activity Capacity">
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-submit m-1">Create</button>
          <a href="{{ route('Activities') }}" class="m-1 btn btn-dark">Cancel</a>
        </div>
    </div>

    </form>
  </div>
</div>

</div>
@include('layouts.footers.auth.footer')
@endsection