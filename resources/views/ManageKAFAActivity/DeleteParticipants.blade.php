@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.subnav', [
'title' => 'Joined Activity',
'subtitle' => 'Delete Participants',
])

@php
$role = Auth::user()->role;
$index=1;
@endphp
<div class="container-fluid py-4">
  <div class="card mb-2">
    <div class="card-header pb-0">
      <p class="font-weight-bold">Delete Participants</p>
    </div>
    <div class="card-body">
      <strong><span class="activityName fs-6 text">Activity Name: </span>
        <span class="fs-6 text">{{ $activity->activityName }}</span></strong>
      <form id="deleteParticipantsForm" action="{{route('delete-participants', [$activity->activityID])}}" method="POST">
        @csrf
        <input type="hidden" name="activityID" value="{{ $activity->activityID }}">
        @if (empty($students))
        <p class="text-center">No data available in table</p>
        @else
        @foreach ($students as $student)
        <div class="form-check mt-3">
          <input class="form-check-input participant-checkbox" type="checkbox" name="participants[]"
            value="{{ $student->student_ID }}" id="defaultCheck{{$index++}}">
          <label class="mt-1" for="defaultCheck{{$index++}}">
            {{$loop->iteration}}. {{ $student->full_name ? $student->full_name : ' ' }}
            [{{ $student->ic ? $student->ic : ' ' }}]
          </label>
        </div>
        @endforeach
        @endif
        <div class="text-center">
          <button type="submit" class="btn btn-submit m-1">Submit</button>
          <a href="{{ route('Activities') }}" class="m-1 btn btn-dark">Cancel</a>
        </div>
      </form>
    </div>
  </div>

</div>
@include('layouts.footers.auth.footer')
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('deleteParticipantsForm');
  const checkboxes = form.querySelectorAll('.participant-checkbox');

  checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function() {
      // Create an array to store the selected participant values
      const selectedParticipants = [];
      // Iterate over all checkboxes to find the selected ones
      checkboxes.forEach(cb => {
        if (cb.checked) {
          // Add the value of the selected checkbox to the array
          selectedParticipants.push(cb.value);
        }
      });

      // Set the value of the hidden input field to the selected participants array
      form.querySelector('input[name="participants"]').value = JSON.stringify(selectedParticipants);
      // Submit the form
      form.submit();
    });
  });
});
</script>