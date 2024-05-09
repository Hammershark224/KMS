@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.subnav', [
        'title' => 'Result List',
        'subtitle' => 'Edit Student Result',
    ])
    <div class="container-fluid py-4">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <p class="font-weight-bold">Edit Student Result</p>
            </div>
            <div class="card-body">
                <form action="">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="index_no">Candidate Name/Nama Calon</label>
                            </div>
                        </div>
                        <div class="col-md-1">
                            :
                        </div>
                        <div class="col-md-7">
                            <input disabled type="text" class="form-control" id="stu_name" name="stu_name"
                                value="{{ $student->full_name ? $student->full_name : ' ' }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="index_no">IC No/No Kad Pengenalan</label>
                            </div>
                        </div>
                        <div class="col-md-1">
                            :
                        </div>
                        <div class="col-md-7">
                            <input disabled type="text" class="form-control" id="stu_ic" name="stu_ic"
                                value="{{ $result->stu_ic ? $result->stu_ic : ' ' }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="index_no">Exam Center/Pusat Pemeriksaan</label>
                            </div>
                        </div>
                        <div class="col-md-1">
                            :
                        </div>
                        <div class="col-md-7">
                            <select class="form-select" name="exam_center_id">
                                <option disabled selected>Select Exam Center</option>
                                @foreach ($examCenters as $examCenter)
                                    <option value="{{ $examCenter->code }}"
                                        {{ old('exam_center_id', $result->exam_center_id) == $examCenter->code ? 'selected' : ' ' }}>
                                        {{ $examCenter->value }}</option>
                                @endforeach
                            </select>
                            @error('exam_center')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="index_no">Year/Tahun</label>
                            </div>
                        </div>
                        <div class="col-md-1">
                            :
                        </div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" id="year" name="year"
                                value="{{ $result->year ? $result->year : ' ' }}">
                        </div>
                    </div>
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>KOD</th>
                                <th>MATA PELAJARAN</th>
                                <th>GRED</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($courses as $course)
                                <tr>
                                    <td>{{ $course->code }}</td>
                                    <td>{{ $course->value }}</td>
                                    <td>
                                        @php
                                            $gradeName = '';
                                        @endphp
                                        @if ($course->code == 'UPPK01')
                                            {{ $gradeName = 'grade_quran' }}
                                        @elseif ($course->code == 'UPPK02')
                                            {{ $gradeName = 'grade_syariah' }}
                                        @elseif ($course->code == 'UPPK03')
                                            {{ $gradeName = 'grade_sirah' }}
                                        @elseif ($course->code == 'UPPK04')
                                            {{ $gradeName = 'grade_adab' }}
                                        @elseif ($course->code == 'UPPK05')
                                            {{ $gradeName = 'grade_jawi' }}
                                        @elseif ($course->code == 'UPPK06')
                                            {{ $gradeName = 'grade_lughah' }}
                                        @elseif ($course->code == 'UPPK07')
                                            {{ $gradeName = 'grade_pchi' }}
                                        @elseif ($course->code == 'UPPK08')
                                            {{ $gradeName = 'grade_solat' }}
                                        @endif
                                        <select style="border-radius: 5px;" name="{{ $gradeName }}" id="gred">
                                            <option disabled selected value="NULL">Grade</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
        <div style="text-align: right;">
            <button class="btn btn-submit m-1">Submit</button>
            <a href="{{ route('results-list') }}" class="m-1 btn btn-dark">Back</a>
        </div>
    </div>
    @include('layouts.footers.auth.footer')
@endsection
