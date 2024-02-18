@extends('layouts.admin')
@section('content')
<div class="card bg-dark" style="min-height: 400px;">
    <div class="card-header d-flex justify-content-between">
        {{ __('Dashboard') }}
        <div>
            <i class="fa-solid fa-clock text-dark"></i> {{(date_diff(date_create(date_format(Auth()->user()->updated_at,'Y-m-d')),date_create(date('Y-m-d'))))->format('%a/30 days')}}
        </div>
    </div>

    <div class="card-body">

        <div>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-4 col-6 p-2 ">
                <a href="{{route('course.index')}}" style="text-decoration: none;" class="link">
                    <div class="card p-1 text-center bg-success text-light">
                        <h1 class="bi bi-person-vcard-fill m-3"></h1>
                        <p class="text-center">Courses</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-6 p-2">
                <a href="/student" style="text-decoration: none;" class="link">
                    <div class="card p-1 text-center bg-warning text-light">
                        <h1 class="bi bi-people m-3"></h1>
                        <p class="text-center">Students</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-6 p-2 ">
                <a href="" style="text-decoration: none;" class="link">
                    <div class="card p-1 text-center bg-primary text-light">
                        <h1 class="bi bi-mortarboard m-3"></h1>
                        <p class="text-center">Semester Records</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-6 p-2">
                <a href="{{route('user.index')}}" style="text-decoration: none;" class="link">
                    <div class="card p-1 text-center">
                        <i class="fas fa-users fa-2x m-3"></i>
                        <p class="text-center">Users</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-6 p-2">
                <a href="{{route('sem.index')}}" style="text-decoration: none;" class="link">
                    <div class="card p-1 text-center">
                        <i class="fa fa-gears fa-2x m-3"></i>
                        <p class="text-center">Semester</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection