@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')

@php
    $role = Auth::user()->role;
@endphp

    @if ($role == "k_admin")
    @include('layouts.navbars.auth.subnav', [
        'title' => 'Student List',
        'subtitle' => 'Student List',
    ])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0" style="display: flex; justify-content: space-between; align-items: center;">
                        <p class="font-weight-bold">Student List</p>
                    </div>
                    @if (session('error'))
                    <div id="error-message" class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            setTimeout(function() {
                                var errorMessage = document.getElementById('error-message');
                                if (errorMessage) {
                                    errorMessage.style.display = 'none';
                                }
                            }, 5000); // 5000 milliseconds = 5 seconds
                        });
                    </script>
                    @endif
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            No</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Name</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Date Apply</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($students != null)
                                    @php
                                        $index = 1;
                                    @endphp
                                    @foreach ($students as $student)
                                    <tr>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $index }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex px-1 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $student->full_name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $student->date_birth }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $student->status }}</span>
                                        </td>
                                        <td class="align-middle text-center ">
                                            <a href="{{ route('student.edit', $student->student_ID) }}"
                                                class="m-1 text-white text-secondary btn btn-primary btn-sm"
                                                data-toggle="tooltip" data-original-title="Edit">
                                                <i class="fa fa-pen"></i>
                                            </a>
                                            <a href="{{ route('student.delete', $student->student_ID) }}"
                                                class="m-1 text-white text-secondary btn btn-danger btn-sm"
                                                data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Confirm to delete {{ $student->full_name }}?')">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @php
                                        $index++;
                                    @endphp
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
    @endif
    
    @if ($role == "parent")
    @include('layouts.navbars.auth.subnav', [
        'title' => 'Children List',
        'subtitle' => 'Children List',
    ])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0" style="display: flex; justify-content: space-between; align-items: center;">
                        <p class="font-weight-bold">Children List</p>
                        <a class="btn btn-add" href="{{ route('children.add') }}">Create New</a>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            No</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Name</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Date Apply</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($children != null)
                                        @php
                                            $index = 1;
                                        @endphp
                                    @foreach ($children as $child)
                                    <tr>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $index }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex px-1 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $child->full_name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $child->date_birth }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $child->status }}</span>
                                        </td>
                                        <td class="align-middle text-center ">
                                            <a href="{{ route('children.show', $child->student_ID) }}"
                                                class="m-1 text-white text-secondary btn btn-info btn-sm"
                                                data-toggle="tooltip" data-original-title="View">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('student.delete', $child->student_ID) }}"
                                                class="m-1 text-white text-secondary btn btn-danger btn-sm"
                                                data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Confirm to delete {{ $child->full_name }}?')">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @php
                                        $index++;
                                    @endphp
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
    @endif
    @include('layouts.footers.auth.footer')
@endsection
