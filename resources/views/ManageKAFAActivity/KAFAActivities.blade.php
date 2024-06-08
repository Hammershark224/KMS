@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'KAFAActivities'], ['subtitle' => 'KAFA Activities'])

@php
$role = Auth::user()->role;
@endphp

<div class="container-fluid">
  <div class="row">

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4 border border-dark">
            <div class="card-header pb-0" style="display: flex; justify-content: space-between; align-items: center;">
              <p class="font-weight-bolder" style="margin: 0;">Upcoming KAFA Activities</p>
              @if ($role == "k_admin" || $role == "staff")
              <a class="btn btn-add" href="{{ route('create-activity') }}">+ Create Activity</a>
              @endif
            </div>

            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        No</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        Activity Name</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Activity Details</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Location, Date, Time</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Capacity</th>
                      <th
                        class="text-center text-secondary text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Operation</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                    $index = 1;
                    @endphp
                    @forelse ($upcomingActivities as $data)
                    <tr>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ $index ++ }}</span>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <span class="text-secondary text-xs font-weight-bold">{{ $data->activityName }}</span>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-secondary text-xs font-weight-bold">{{ $data->activityDetails }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <div class="d-flex flex-column justify-content-center">
                          <span class="text-secondary text-xs font-weight-bold">{{ $data->activityLocation }}</span>
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <span class="text-secondary text-xs">{{ $data->activityDate }}</span>
                          <span class="text-secondary text-xs">{{ $data->startTime }} to {{ $data->endTime }}</span>
                        </div>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ $data->activityCapacity }}</span>
                      </td>
                      <td class="align-middle">
                        @if ($role == "k_admin" || $role == "staff")
                        <a href="{{ route('view-activity',['id' => $data->activityID]) }}"
                          class="p-1 text-white text-secondary button view-bg justify-content-center ps-2 me-2 border border-dark"
                          data-toggle="tooltip" data-original-title="View">
                          <i class="fa fa-eye"></i>
                        </a>
                        <a href="{{ route('edit-activity',['id' => $data->activityID]) }}"
                          class="p-1 text-white text-secondary button edit-bg ps-2 pe-1 me-2 border border-dark"
                          data-toggle="tooltip" data-original-title="Edit">
                          <i class="fa fa-pencil"></i>
                        </a>
                        <a href="{{route('delete-activity',['id' => $data->activityID])}}"
                          class="p-1 text-white text-secondary button bg-danger ps-2 pe-2 border border-dark"
                          data-toggle="tooltip" data-original-title="Delete"
                          onclick="return confirm('Are you sure you want to delete this activity?');">
                          <i class="fa fa-trash"></i>
                        </a>
                        @endif
                        @if ($role == "parent")
                        <div class="text-center">
                          <a href="{{ route('view-activity',['id' => $data->activityID]) }}"
                            class="p-1 text-white text-secondary button view-bg justify-content-center ps-2 me-2 border border-dark"
                            data-toggle="tooltip" data-original-title="View">
                            <i class="fa fa-eye"></i> <span class="text-black me-2">View</span>
                          </a>
                        </div>
                        @endif
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="6" class="text-center">No data available in table</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="card mb-4 border border-dark">
            <div class="card-header pb-0" style="display: flex; justify-content: space-between; align-items: center;">
              <p class="font-weight-bolder" style="margin: 0;">Previous KAFA Activities</p>
            </div>
            @php
            $index = 1;
            @endphp
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        No</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        Activity Name</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Activity Details</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Location, Date, Time</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Capacity</th>
                      <th
                        class="text-center text-secondary text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Operation</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($previousActivities as $data)
                    <tr>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ $index ++ }}</span>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <span class="text-secondary text-xs font-weight-bold">{{ $data->activityName }}</span>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-secondary text-xs font-weight-bold">{{ $data->activityDetails }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <div class="d-flex flex-column justify-content-center">
                          <span class="text-secondary text-xs font-weight-bold">{{ $data->activityLocation }}</span>
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <span class="text-secondary text-xs">{{ $data->activityDate }}</span>
                          <span class="text-secondary text-xs">{{ $data->startTime }} to {{ $data->endTime }}</span>
                        </div>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ $data->activityCapacity }}</span>
                      </td>
                      <td class="align-middle">
                        @if ($role == "k_admin" || $role == "staff")
                        <a href="{{ route('view-activity',['id' => $data->activityID]) }}"
                          class="p-1 text-white text-secondary button view-bg justify-content-center ps-2 ms-4 me-2 border border-dark"
                          data-toggle="tooltip" data-original-title="View">
                          <i class="fa fa-eye"></i>
                        </a>
                        <a href="{{route('delete-activity',['id' => $data->activityID])}}"
                          class="p-1 text-white text-secondary button bg-danger ps-2 pe-2 border border-dark"
                          data-toggle="tooltip" data-original-title="Delete"
                          onclick="return confirm('Are you sure you want to delete this activity?');">
                          <i class="fa fa-trash"></i>
                        </a>
                        @endif
                        @if ($role == "parent")
                        <div class="text-center">
                          <a href="{{ route('view-activity',['id' => $data->activityID]) }}"
                            class="p-1 text-white text-secondary button view-bg justify-content-center ps-2 me-2 border border-dark"
                            data-toggle="tooltip" data-original-title="View">
                            <i class="fa fa-eye"></i> <span class="text-black me-2">View</span>
                          </a>
                        </div>
                        @endif
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="6" class="text-center">No data available in table</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('layouts.footers.auth.footer')
  @endsection
  <script>
  window.onload = function() {
    @if(session('success'))
    alert("{{ session('success') }}");
    @endif

    @if(session('error'))
    alert("{{ session('error') }}");
    @endif
  }
  </script>
  <script>
  function deleteActivity(activityId) {
    if (confirm('Are you sure you want to delete this activity?')) {
      // Send a DELETE request using fetch API
      fetch(`/activities/${activityId}`, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
          },
        })
        .then(response => {
          if (response.ok) {
            // Redirect or update UI as needed
            // For example, you can redirect to another page
            window.location.href = '/activities';
          } else {
            // Handle error
            console.error('Failed to delete activity');
          }
        })
        .catch(error => {
          console.error('Error:', error);
        });
    }
  }
  </script>