@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'JoinedActivities'], ['subtitle' => 'Joined Activities'])

@php
$role = Auth::user()->role;
@endphp

<div class="container-fluid">
  <div class="row">

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0" style="display: flex; justify-content: space-between; align-items: center;">
              <p class="font-weight-bold mx-0">Joined Activities</p>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        No</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        Activity Name</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Activity Details</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Location, Date, Time</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Childeren Involved</th>
                      <th class="text-secondary text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Operation</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if ($groupedActivities != null)
                    @foreach ($groupedActivities as $activityID => $activityData)
                    <tr>
                      <td class="align-middle text-center text-secondary text-xs font-weight-bold">
                        {{ $loop->iteration }}</td>
                      <td class="align-middle text-center text-secondary text-xs font-weight-bold">
                        {{ $activityData['activity']->activityName }}</td>
                      <td class="align-middle text-center text-secondary text-xs font-weight-bold">
                        {{ $activityData['activity']->activityDetails }}</td>
                      <td class="align-middle text-center text-secondary text-xs font-weight-bold">
                        {{  $activityData['activity']->activityLocation }},
                        {{  $activityData['activity']->activityDate }}, {{  $activityData['activity']->startTime }} -
                        {{  $activityData['activity']->endTime }}</td>
                      <td class="align-middle text-center text-secondary text-xs font-weight-bold">
                        @foreach ($activityData['children'] as $child)
                        {{ $child }} <br>
                        @endforeach
                      </td>
                      <td class="align-middle text-center">
                        <div class="text-center">
                          <a href="#"
                            class="p-1 text-white text-secondary button view-bg justify-content-center ps-2 me-2 border border-dark"
                            data-toggle="tooltip" data-original-title="View">
                            <i class="fa fa-eye"></i> <span class="text-black me-2">View</span>
                          </a>
                        </div>
                      </td>
                    </tr>
                    @endforeach

                    @else
                    <tr>
                      <td colspan="6" class="text-center">No data available in table</td>
                    </tr>
                    @endif

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