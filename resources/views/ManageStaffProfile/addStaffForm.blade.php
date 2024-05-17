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
                <form role="form" method="POST" action="{{ route('staff.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Add Staff Form</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Full Name</label>
                                    <input class="form-control" type="text" name="full_name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">IC No. </label>
                                    <input class="form-control" type="text" name="ic">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Contact No. </label>
                                    <input class="form-control" type="number" name="phone_num">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Email</label>
                                    <input class="form-control" type="email" name="email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Password</label>
                                    <input class="form-control" type="text" name="password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select class="form-control"  name="gender" required>
                                        <option disabled selected value="">Select...</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Staff ID</label>
                                    <input class="form-control" type="text" name="identity">
                                </div>
                            </div>        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Program</label>
                                    <select class="form-control"  name="program" required>
                                        <option disabled selected value="">Select...</option>
                                        <option value="Bidang Al Quran">Bidang Al Quran</option>
                                        <option value="Ulum Syariah">Ulum Syariah</option>
                                        <option value="Sirah">Sirah</option>
                                        <option value="Adab">Adab</option>
                                        <option value="Pelajaran Jawi dan Khat">Pelajaran Jawi dan Khat</option>
                                        <option value="Lughah Al-Quran">Lughah Al-Quran</option>
                                        <option value="Penghayatan Cara Hidup Islam (PCHI)">Penghayatan Cara Hidup Islam (PCHI)</option>
                                        <option value="Amali Solat">Amali Solat</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary btn-sm mx-2">Apply</button>
                        <a href="{{ route('staff.manage') }}" class="btn btn-secondary btn-sm mx-2">Back</a>
                    </div>
                </form>
            </div>
        </div> 
    </div>
    @include('layouts.footers.auth.footer')
</div>
@endsection
