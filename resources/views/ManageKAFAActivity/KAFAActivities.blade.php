@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'KAFAActivities'], ['subtitle' => 'KAFA Activities'])

@php
$role = Auth::user()->role;
@endphp

<div class="container-fluid">
  @if ($role == "k_admin")

  @endif

  <div class="row">

    @if ($role == "parent")
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0" style="display: flex; justify-content: space-between; align-items: center;">
              <p style="margin: 0;">KAFA Activities</p>
              <a href="">+ Create Activity</a>
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
                        Capacity</th>
                      <th class="text-secondary text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Operation</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">1</span>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <span class="text-secondary text-xs font-weight-bold">Welcome Party</span>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-secondary text-xs font-weight-bold">This is a welcome activity</span>
                      </td>
                      <td class="align-middle text-center">
                        <div class="d-flex flex-column justify-content-center">
                          <span class="text-secondary text-xs font-weight-bold">Pandang Sekolah</span>
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <span class="text-secondary text-xs">06/05/2024</span>
                          <span class="text-secondary text-xs">12:00pm to 2:00pm</span>
                        </div>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">10</span>
                      </td>
                      <td class="align-middle">
                        <a href="" class="p-1 text-white text-secondary button view-bg justify-content-center ps-2 me-2 border border-dark" data-toggle="tooltip"
                          data-original-title="View">
                          <i class="fa fa-eye"></i>
                        </a>
                        <a href="#" class="p-1 text-white text-secondary button edit-bg ps-2 pe-1 me-2 border border-dark" data-toggle="tooltip"
                          data-original-title="Edit">
                          <i class="fa fa-pencil"></i>
                        </a>
                        <a href="#" class="p-1 text-white text-secondary button bg-danger ps-2 pe-2 border border-dark" data-toggle="tooltip"
                          data-original-title="Delete">
                          <i class="fa fa-trash"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endif

      @if ($role == "staff")

      @endif
    </div>
  </div>
  @include('layouts.footers.auth.footer')
  @endsection

  @push('js')
  <script src="./assets/js/plugins/chartjs.min.js"></script>
  <script>
  var ctx1 = document.getElementById("chart-line").getContext("2d");

  var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

  gradientStroke1.addColorStop(1, 'rgba(251, 99, 64, 0.2)');
  gradientStroke1.addColorStop(0.2, 'rgba(251, 99, 64, 0.0)');
  gradientStroke1.addColorStop(0, 'rgba(251, 99, 64, 0)');
  new Chart(ctx1, {
    type: "line",
    data: {
      labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
      datasets: [{
        label: "Mobile apps",
        tension: 0.4,
        borderWidth: 0,
        pointRadius: 0,
        borderColor: "#fb6340",
        backgroundColor: gradientStroke1,
        borderWidth: 3,
        fill: true,
        data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
        maxBarThickness: 6

      }],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false,
        }
      },
      interaction: {
        intersect: false,
        mode: 'index',
      },
      scales: {
        y: {
          grid: {
            drawBorder: false,
            display: true,
            drawOnChartArea: true,
            drawTicks: false,
            borderDash: [5, 5]
          },
          ticks: {
            display: true,
            padding: 10,
            color: '#fbfbfb',
            font: {
              size: 11,
              family: "Open Sans",
              style: 'normal',
              lineHeight: 2
            },
          }
        },
        x: {
          grid: {
            drawBorder: false,
            display: false,
            drawOnChartArea: false,
            drawTicks: false,
            borderDash: [5, 5]
          },
          ticks: {
            display: true,
            color: '#ccc',
            padding: 20,
            font: {
              size: 11,
              family: "Open Sans",
              style: 'normal',
              lineHeight: 2
            },
          }
        },
      },
    },
  });
  </script>
  @endpush