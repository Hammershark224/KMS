@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.subnav', [
        'title' => 'Result List',
        'subtitle' => 'Student Result List',
    ])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0" style="display: flex; justify-content: space-between; align-items: center;">
                        <p class="font-weight-bold">Student Results List</p>
                        <a class="btn btn-add" href="{{ route('add-result') }}">+ Add Results</a>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            No</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Name</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            IC No</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Exam Center</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Year</th>
                                        <th class="text-center text-secondary opacity-7">Operation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($datas->studentApplication != null)
                                        @php
                                            $index = 1;
                                        @endphp
                                        @foreach ($datas->studentApplication as $data)
                                            @foreach ($data->results as $result)
                                                <tr>
                                                    <td class="align-middle text-center">
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">{{ $index }}</span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">{{ $data->full_name ? $data->full_name : ' ' }}</span>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">{{ $data->ic ? $data->ic : ' ' }}</span>
                                                    </td>

                                                    <td class="align-middle text-center">
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">{{ $result->exam_center ? $result->exam_center : ' ' }}</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">{{ $result->year ? $result->year : ' ' }}</span>
                                                    </td>

                                                    <td class="align-middle text-center ">
                                                        <a href="{{ route('view-result') }}"
                                                            class="m-1 text-white text-secondary btn btn-view btn-sm"
                                                            data-toggle="tooltip" data-original-title="View">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('edit-result', ['stu_ic' => '111122223333']) }}"
                                                            class="m-1 text-white text-secondary btn btn-edit btn-sm"
                                                            data-toggle="tooltip" data-original-title="Edit">
                                                            <i class="fa fa-pen"></i>
                                                        </a>
                                                        <a href="{{ route('delete-result') }}"
                                                            class="m-1 text-white text-secondary btn btn-delete btn-sm"
                                                            data-toggle="tooltip" data-original-title="Delete">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
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
    @include('layouts.footers.auth.footer')
@endsection
