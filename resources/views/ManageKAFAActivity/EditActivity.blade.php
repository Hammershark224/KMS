@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.subnav', [
'title' => 'Activity List',
'subtitle' => 'Edit Activity',
])
@php
$role = Auth::user()->role;
@endphp

<div class="container-fluid py-4">
  <div class="card mb-4">
    <div class="card-header pb-0">
      <p class="font-weight-bold">Edit Activity</p>
    </div>
    <div class="card-body">
      <form>
        <div class="form-group">
          <label for="activityName">Activity Name</label>
          <input type="text" class="form-control" id="activityName" aria-describedby="activityName"
            value="Welcome Activity">
        </div>
        <div class="form-group">
          <label for="activityDescription">Activity Description</label>
          <textarea class="form-control" id="activityDescription" rows="3">This is a welcome activity</textarea>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="activityDate">Activity Date</label>
              <input type="date" class="form-control" id="activityDate" value="2024-05-06">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="activityLocation">Activity Location</label>
              <input type="text" class="form-control" id="activityLocation" value="Pandang Sekolah">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="startTime">Start Time</label>
              <input type="time" class="form-control" id="startTime" value="12:00">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="endTime">End Time</label>
              <input type="time" class="form-control" id="endTime" value="14:00">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="activityCapacity">Activity Capacity</label>
          <input type="number" class="form-control" id="activityCapacity" value="10">
        </div>
        <div class="text-center">
          <button class="btn btn-submit m-1">Submit</button>
          <a href="{{ route('Activities') }}" class="m-1 btn btn-dark">Back</a>
        </div>
    </div>

    </form>
  </div>
</div>

</div>
@include('layouts.footers.auth.footer')
@endsection