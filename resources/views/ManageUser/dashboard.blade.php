@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'], ['subtitle' => 'Welcome to KMS'])

@php
    $role = Auth::user()->role;
@endphp

<div class="container-fluid">
    @if ($role == "k_admin")
    <div class="row">
        <div class="card card-background col m-4">
            <div class="full-background" style="background-image: url('https://images.unsplash.com/photo-1541451378359-acdede43fdf4?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=934&amp;q=80')"></div>
            <div class="card-body">
                <p class="card-title h5 d-block text-white">Hi, {{Auth::user()->username}}</p>
                <p class="card-description mb-4">I am KAFA Admin. </p>   
            </div>
        </div>
    </div>
    @endif  

    <div class="row">
        @if ($role == "MUIP")

        @endif 

        @if ($role == "parent")

        @endif 

        @if ($role == "staff")

        @endif 
    </div>
</div> 
@include('layouts.footers.auth.footer')
@endsection