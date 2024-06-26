@extends('layouts.app')

<!-- navigation bar -->
@include('layouts.navbars.guest.navbar')

@section('content')
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Sign In</h4>
                                    <p class="mb-0">Enter your email, password and user group to sign in</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST" action="{{ route('login.perform') }}">
                                        @csrf
                                        @method('post')
                                        <!-- email input -->
                                        <div class="flex flex-col mb-3">
                                            <input type="email" name="email" class="form-control form-control-lg" value="{{ old('email')}}" placeholder="Email" paaria-label="Email">
                                            @error('email') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>

                                        <!-- password input -->
                                        <div class="flex flex-col mb-3">
                                            <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password">
                                            @error('password') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>

                                        <!-- role selection -->
                                        <div class="flex flex-col mb-3">
                                        <select name="role" class="form-control" placeholder="Select your user group">
                                            <option selected disabled>Select your user group</option>
                                            <option value="k_admin">KAFA Admin</option>
                                            <option value="MUIP">MUIP Admin</option>
                                            <option value="parent">Parent</option>
                                            <option value="staff">Staff</option>
                                        </select>
                                        @error('role') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                        </div>

                                        <!-- remember me toggle -->
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="remember" type="checkbox" id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div>

                                        <!-- submit button -->
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-1 text-sm mx-auto">
                                        Forgot you password? Reset your password
                                        <a href="{{ route('reset-password') }}" class="text-primary text-gradient font-weight-bold">here</a>
                                    </p>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Don't have an account?
                                        <a href="{{ route('register') }}" class="text-primary text-gradient font-weight-bold">Sign up</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                                style="background-image: url('https://yuran.b-cdn.net/wp-content/uploads/2022/04/Sekolah-Rakyat.jpg');
              background-size: cover;">
                                <span class="mask bg-gradient-secondary opacity-4"></span>
                                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Welcome back!"</h4>
                                <p class="text-white position-relative">Login to explore a world of ease and control.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
