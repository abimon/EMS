@extends('layouts.tables')
@section('content')
<div class="container bg-white">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <h4 class="text-uppercase text-center mt-2 mb-2">{{$course->course_name}}</h4>
    <div class="accordion accordion-flush" id="accordionFlushExample">
        <ul class="nav  justify-content-between">
                @for($i=1;$i<=7;$i++) 
                @if($course->units->where('yearG',$i)->count()>0)
                <li class="nav-item accordion-item">
                    <a class="nav-link" aria-current="page" href="/examExport/{{$course->id}}/{{$course->id}}/{{$i}}" >
                        Year {{$i}}
                    </a>
                </li>
                @endif
                @endfor
                
        </ul>
        </div>
</div>
@endsection