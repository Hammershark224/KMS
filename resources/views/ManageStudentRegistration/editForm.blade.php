@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')

@php
    $role = Auth::user()->role;
@endphp

@include('layouts.navbars.auth.subnav', [
    'title' => 'View',
    'subtitle' => 'View',
])
<div id="alert">
    @include('components.alert')
</div>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form role="form" method="POST" action="{{ route('student.update') }}" enctype="multipart/form-data">
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
                                    <input class="form-control" type="text" name="full_name" value="{{ $student->full_name }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">IC No. </label>
                                    <input class="form-control" type="text" name="ic" value="{{ $student->ic }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select class="form-control" disabled>
                                        <option disabled selected value="">Gender</option>
                                        <option value="male" @if($student->gender=='male') selected @endif >Male</option>
                                        <option value="female" @if($student->gender=='female') selected @endif >Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Date of Birth</label>
                                    <input class="form-control" type="date" name="date_birth" value="{{ $student->date_birth }}" readonly>
                                </div>
                            </div>        
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Address</label>
                                    <textarea class="form-control" name="address" disabled>{{ $student->address }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Status</label>
                                    <input class="form-control" type="text" name="status" value="{{ $student->status }}">
                                </div>
                            </div>    
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary btn-sm mx-2">Save</button>
                                <a href="{{ route('student.manage') }}" class="btn btn-secondary btn-sm mx-2">Back</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div> 
    </div>
    @include('layouts.footers.auth.footer')
</div>
@endsection
