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
                            <input type="text" class="form-control" id="stu_name" name="stu_name"
                                value="{{ $result->year ? $result->year : ' ' }}">
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
                            <input type="text" class="form-control" id="stu_ic" name="stu_ic"
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
                            <input type="text" class="form-control" id="exam_center" name="exam_center"
                                value="{{ $result->exam_center ? $result->exam_center : ' ' }}">
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
                </form>
            </div>
        </div>
        <div style="text-align: right;">
            <button class="btn btn-info m-1">Submit</button>
            <a href="{{route('results-list')}}" class="m-1 btn btn-dark">Back</a>
        </div>
    </div>
    @include('layouts.footers.auth.footer')
@endsection
