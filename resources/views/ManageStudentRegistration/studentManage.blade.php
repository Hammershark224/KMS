@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
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
                                    @foreach ($students as $student)
                                    <tr>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">1</span>
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
                                            <a href="{{ route('student.view',  $student['student_ID']) }}"
                                                class="m-1 text-white text-secondary btn btn-info btn-sm"
                                                data-toggle="tooltip" data-original-title="View">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('edit-result', ['stu_ic' => '111122223333']) }}"
                                                class="m-1 text-white text-secondary btn btn-primary btn-sm"
                                                data-toggle="tooltip" data-original-title="Edit">
                                                <i class="fa fa-pen"></i>
                                            </a>
                                            <a href="{{ route('delete-result') }}"
                                                class="m-1 text-white text-secondary btn btn-danger btn-sm"
                                                data-toggle="tooltip" data-original-title="Delete">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth.footer')
@endsection
