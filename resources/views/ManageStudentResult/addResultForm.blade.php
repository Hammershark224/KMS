@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.subnav')
    @error('stu_ic')
        <script>
            confirm('IC number not found, please check again.');
        </script>
    @enderror
    <div class="container-fluid py-4">
        <div class="card mb-4">
            <div class="card-header pb-0 mt-1">
                <p class="font-weight-bold">Add Student Result</p>
            </div>
            <div class="card-body">
                <form id="form-id" action="{{ route('add-result.perform') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="stu_ic">IC No/No Kad Pengenalan</label>
                            </div>
                        </div>
                        <div class="col-md-1">
                            :
                        </div>
                        <div class="col-md-7">
                            <input type="text" class="form-control @error('stu_ic') is-invalid @enderror" id="stu_ic"
                                name="stu_ic" required value="{{ old('stu_ic') }}">
                            @error('stu_ic')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exam_center_id">Exam Center/Pusat Pemeriksaan</label>
                            </div>
                        </div>
                        <div class="col-md-1">
                            :
                        </div>
                        <div class="col-md-7">
                            <select required class="form-select @error('exam_center_id') is-invalid @enderror"
                                name="exam_center_id">
                                <option disabled selected>Select Exam Center</option>
                                @foreach ($examCenters as $examCenter)
                                    <option {{ old('exam_center_id') ? 'selected' : '' }} value="{{ $examCenter->code }}">
                                        {{ $examCenter->value }}</option>
                                @endforeach
                            </select>
                            @error('exam_center_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="year">Year/Tahun</label>
                            </div>
                        </div>
                        <div class="col-md-1">
                            :
                        </div>
                        <div class="col-md-7">
                            <select required class="form-select @error('year') is-invalid @enderror" name="year"
                                id="year">
                                <option value="Null" selected disabled>Select Year</option>
                                @for ($i = 2024; $i >= 2014; $i--)
                                    <option {{ old('year') == $i ? 'selected' : '' }} value="{{ $i }}">
                                        {{ $i }}</option>
                                @endfor
                            </select>
                            @error('year')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">KOD</th>
                                <th class="text-center">MATA PELAJARAN</th>
                                <th class="text-center">GRED</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                                <tr>
                                    <td class="text-center">{{ $course->code }}</td>
                                    <td>{{ $course->value }}
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $gradeNames = [
                                                'UPKK01' => 'grade_quran',
                                                'UPKK02' => 'grade_syariah',
                                                'UPKK03' => 'grade_sirah',
                                                'UPKK04' => 'grade_adab',
                                                'UPKK05' => 'grade_jawi',
                                                'UPKK06' => 'grade_lughah',
                                                'UPKK07' => 'grade_pchi',
                                                'UPKK08' => 'grade_solat',
                                            ];
                                        @endphp
                                        <select required
                                            class="form-select text-center w-75 mx-auto @error($gradeNames[$course->code]) is-invalid @enderror"
                                            style="border-radius: 5px;" name="{{ $gradeNames[$course->code] }}"
                                            id="gred">
                                            <option disabled selected value="NULL">Grade</option>
                                            <option {{ old($gradeNames[$course->code]) == 'A' ? 'selected' : '' }}
                                                value="A">A</option>
                                            <option {{ old($gradeNames[$course->code]) == 'B' ? 'selected' : '' }}
                                                value="B">B</option>
                                            <option {{ old($gradeNames[$course->code]) == 'C' ? 'selected' : '' }}
                                                value="C">C</option>
                                            <option {{ old($gradeNames[$course->code]) == 'D' ? 'selected' : '' }}
                                                value="D">D</option>
                                        </select>
                                    </td>
                                    @error($gradeNames[$course->code])
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div style="text-align: right;">
                        <button class="btn btn-submit m-1 w-10">Submit</button>
                        <a href="{{ route('results-list') }}" class="m-1 btn btn-dark">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth.footer')
@endsection
