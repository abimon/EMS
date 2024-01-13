@extends('layouts.tables')
@section('content')
<div class="card col-md-8 col-11">
    <div class="card-header">{{ __('Dashboard') }}</div>

    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div>
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                {{ __('You are logged in!') }}
            </div>
            <div>
                <i class="fa-solid fa-clock text-secondary"></i> {{(date_diff(date_create(date_format(Auth()->user()->updated_at,'Y-m-d')),date_create(date('Y-m-d'))))->format('%a day(s)')}} 
                
            </div>
        </div>
        <div class="row d-flex justify-content-between">
            <div class="col-md-4 col-6 p-2">
                <a href="{{route('course.index')}}" style="text-decoration: none;" class="link">
                    <div class="card p-1 text-center">
                    <h1 class="bi bi-person-vcard-fill m-3"></h1>
                        <p class="text-center">Courses</p>
                    </div>
                </a>
            </div>
            <!-- 
                <div class="col-md-4 col-6 p-2">
                <a href="{{route('user.index')}}" style="text-decoration: none;" class="link">
                    <div class="card p-1 text-center">
                        <i class="fas fa-users fa-2x m-3"></i>
                        <p class="text-center">Users</p>
                    </div>
                </a>
                </div>
                <div class="col-md-4 col-6 p-2">
                    <a href="/recharge" style="text-decoration: none;" class="link">
                        <div class="card p-1 text-center">
                            <i class="fa-solid fa-donate fa-2x m-3"></i>
                            <p class="text-center">Top Up</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-6 p-2">
                    <a href="/bulk" style="text-decoration: none;" class="link">
                        <div class="card p-1 text-center">
                            <i class="fa fa-comments fa-2x m-3"></i>
                            <p class="text-center">Send Bulk</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-6 p-2">
                    <a href="/single" style="text-decoration: none;" class="link">
                        <div class="card p-1 text-center">
                            <i class="fa fa-comment fa-2x m-3"></i>
                            <p class="text-center">Send Single</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-6 p-2">
                    <a href="/integrate" style="text-decoration: none;" class="link">
                        <div class="card p-1 text-center">
                            <i class="fa fa-code-branch fa-2x m-3"></i>
                            <p class="text-center">Integrate</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-6 p-2">
                    <a href="{{route('exams.index')}}" style="text-decoration: none;" class="link">
                        <div class="card p-1 text-center">
                            <i class="fa fa-list-check fa-2x m-3"></i>
                            <p class="text-center">Exams</p>
                        </div>
                    </a>
                </div> 
            -->
        </div>
    </div>
</div>
@endsection