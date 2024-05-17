@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
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
                <form role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">View Staff</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Full Name</label>
                                    <input class="form-control" type="text" name="full_name" value="{{ $staff->user->full_name }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">IC No. </label>
                                    <input class="form-control" type="text" name="ic" value="{{ $staff->user->ic }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Contact No. </label>
                                    <input class="form-control" type="number" name="phone_num" value="{{ $staff->user->phone_num }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Email</label>
                                    <input class="form-control" type="email" name="email" value="{{ $staff->user->email }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select class="form-control" disabled>
                                        <option disabled selected value="">Gender</option>
                                        <option value="male" @if($staff->user->gender=='male') selected @endif >Male</option>
                                        <option value="female" @if($staff->user->gender=='female') selected @endif >Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Staff ID</label>
                                    <input class="form-control" type="text" name="identity" value="{{ $staff->identity }}" readonly>
                                </div>
                            </div>        
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Program</label>
                                    <select class="form-control"  name="program" disabled>
                                        <option disabled selected value="">Select...</option>
                                        <option value="Bidang Al Quran" @if($staff->program=='Bidang Al Quran') selected @endif>Bidang Al Quran</option>
                                        <option value="Ulum Syariah" @if($staff->program=='Ulum Syariah') selected @endif>Ulum Syariah</option>
                                        <option value="Sirah" @if($staff->program=='Sirah') selected @endif>Sirah</option>
                                        <option value="Adab" @if($staff->program=='Adab') selected @endif>Adab</option>
                                        <option value="Pelajaran Jawi dan Khat" @if($staff->program=='Pelajaran Jawi dan Khatn') selected @endif>Pelajaran Jawi dan Khat</option>
                                        <option value="Lughah Al-Quran" @if($staff->program=='Lughah Al-Quran') selected @endif>Lughah Al-Quran</option>
                                        <option value="Penghayatan Cara Hidup Islam (PCHI)" @if($staff->program=='Penghayatan Cara Hidup Islam (PCHI)') selected @endif>Penghayatan Cara Hidup Islam (PCHI)</option>
                                        <option value="Amali Solat" @if($staff->program=='Amali Solat') selected @endif>Amali Solat</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('staff.manage') }}" class="btn btn-secondary btn-sm mx-2">Back</a>
                    </div>
                </form>
            </div>
        </div> 
    </div>
    @include('layouts.footers.auth.footer')
</div>
@endsection
