@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.subnav', [
'title' => 'Activity List',
'subtitle' => 'Add Participants',
])

@php
$role = Auth::user()->role;
@endphp
<div class="container-fluid py-4">
  <div class="card mb-2">
    <div class="card-header pb-0">
      <p class="font-weight-bold">Add Participants</p>
    </div>
    <div class="card-body">
      <strong><span class="activityName fs-6 text">Activity Name: </span>
        <span class="fs-6 text">{{ $activity->activityName }}</span></strong>
      <form id="addParticipantsForm" action="{{ route('add-participants', ['id' => $activity->activityID]) }}"
        method="POST">
        @csrf
        @if ($datas != null)
        @php
        $index = 1;
        @endphp
        @foreach ($datas as $data)
        @foreach ($data->results as $result)
        <input type="hidden" name="activityID" value="{{ $activity->activityID }}">
        <div class="form-check mt-3">
          <input class="form-check-input participant-checkbox" type="checkbox" name="participants[]"
            value="{{ $data->student_ID }}" id="defaultCheck{{$index++}}">
          <label for="defaultCheck{{$index++}}">
            {{ $data->full_name ? $data->full_name : ' ' }} [{{ $data->ic ? $data->ic : ' ' }}]
          </label>
        </div>


        @endforeach
        @endforeach
        @else
        <p class="text-center">No data available in table</p>

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
    const form = document.getElementById('addParticipantsForm');
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