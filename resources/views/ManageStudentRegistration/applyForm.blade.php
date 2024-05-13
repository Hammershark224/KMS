@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.subnav', [
    'title' => 'Create',
    'subtitle' => 'Create',
])
<div id="alert">
    @include('components.alert')
</div>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form role="form" method="POST" action="{{ route('student.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Application Form</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <p class="text-uppercase text-sm">Parent Information</p>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Parent Name</label>
                                    <input class="form-control" type="text" name="parent_name" value="{{ auth()->user()->full_name }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Parent Email</label>
                                    <input class="form-control" type="text" name="parent_email" value="{{ auth()->user()->email }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Parent Contact</label>
                                    <input class="form-control" type="text" name="parent_contact" value="{{ auth()->user()->phone_num }}" readonly>
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <div class="row">
                            <p class="text-uppercase text-sm">Student Information</p>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Student Name</label>
                                    <input class="form-control" type="text" name="full_name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">IC No. </label>
                                    <input class="form-control" type="text" name="ic">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select class="form-control" required>
                                        <option disabled selected value="">Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                                        
                        </div>
                    </div>
            </div>
        </div> 
    </div>
    @include('layouts.footers.auth.footer')
</div>
@endsection
