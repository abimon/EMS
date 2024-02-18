@extends('layouts.tables')
@section('content')
<div class="container bg-white">
    <h3 class="text-center text-uppercase">{{$sem->sem}} Semester ({{$sem->timelines}})</h3>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="accordion accordion-flush" id="accordionFlushExample">
        <ul class="nav ms-auto me-auto">
            <li class="nav-item accordion-item">
                <a class="nav-link" aria-current="page" href="#" data-bs-toggle="collapse" data-bs-target="#flush-collapsestudents" aria-expanded="false" aria-controls="flush-collapsestudents">
                    <button class="btn btn-primary">Students</button>
                </a>
            </li>
            <li class="nav-item accordion-item">
                <a class="nav-link" aria-current="page" href="#" data-bs-toggle="collapse" data-bs-target="#flush-collapseunits" aria-expanded="false" aria-controls="flush-collapseunits">
                    <button class="btn btn-warning">Units</button>
                </a>
            </li>
            <li class="nav-item accordion-item">
                <a class="nav-link" aria-current="page" href="#" data-bs-toggle="collapse" data-bs-target="#flush-collapseresults" aria-expanded="false" aria-controls="flush-collapseresults">
                    <button class="btn btn-info">Results</button>
                </a>
            </li>
        </ul>
        <div id="flush-collapsestudents" class="accordion-collapse collapse show" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <div class="accordion accordion-flush" id="accordionFlushExampleA">
                    <ul class="nav ms-auto me-auto">
                        @for($i=1;$i<=7;$i++) 
                        @if($sem->students->where('year',$i)->count()>0)
                        <li class="nav-item accordion-item">
                            <a class="nav-link" aria-current="page" href="#" data-bs-toggle="collapse" data-bs-target="#flush-collapsestudents{{$i}}" aria-expanded="false" aria-controls="flush-collapsestudents{{$i}}">
                                Year {{$i}}
                            </a>
                        </li>
                        @endif
                        @endfor
                    </ul>
                    @for($i=1;$i<=7;$i++) 
                    @if($sem->students->where('year',$i)->count()>0)
                    <div id="flush-collapsestudents{{$i}}" class="accordion-collapse collapse {{$i==1?'show':''}}" data-bs-parent="#accordionFlushExampleA">
                        <div class="accordion-body">
                            <h2 class="text-center  text-capitalize">Year {{$i}} Students</h2>
                            <table class="ms-0 table table-responsive">
                            
                                @foreach($sem->students->where('year',$i) as $student)
                                <div class="ms-auto">
                                    <tr>
                                    <td><a href="{{route('students.show',$student->student->id)}}" style='text-decoration:none; color:black;' type="button">{{$student->student->student_name}}</a></li></td>
                                    </tr>
                                </div>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    @endif
                    @endfor
                </div>
            </div>
        </div>
        <div id="flush-collapseunits" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <div class="accordion accordion-flush" id="accordionFlushExampleB">
                    <ul class="nav ms-auto me-auto">
                        @for($i=1;$i<=7;$i++) 
                        @if($sem->units->where('year',$i)->count()>0)
                        <li class="nav-item accordion-item">
                            <a class="nav-link" aria-current="page" href="#" data-bs-toggle="collapse" data-bs-target="#flush-collapseunits{{$i}}" aria-expanded="false" aria-controls="flush-collapseunits{{$i}}">
                                Year {{$i}}
                            </a>
                        </li>
                        @endif
                        @endfor
                    </ul>
                    @for($i=1;$i<=7;$i++) 
                    @if($sem->units->where('year',$i)->count()>0)
                    <div id="flush-collapseunits{{$i}}" class="accordion-collapse collapse {{$i==1?'show':''}}" data-bs-parent="#accordionFlushExampleB">
                        <div class="accordion-body">
                            <h2 class="text-center  text-capitalize">Units for Year {{$i}}</h2>
                            <ol class="ms-0">
                                <hr>
                                <div class="ms-auto">
                                    <li></li>
                                </div>
                                <hr>
                            </ol>
                        </div>
                    </div>
                    @endif
                    @endfor
                </div>
            </div>
        </div>
        <div id="flush-collapseresults" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <div class="accordion accordion-flush" id="accordionFlushExampleC">
                    <ul class="nav ms-auto me-auto">
                        @for($i=1;$i<=7;$i++) 
                        <li class="nav-item accordion-item">
                            <a class="nav-link" aria-current="page" href="#" data-bs-toggle="collapse" data-bs-target="#flush-collapseresults{{$i}}" aria-expanded="false" aria-controls="flush-collapseresults{{$i}}">
                                Year {{$i}}
                            </a>
                        </li>
                        @endfor
                    </ul>
                    @for($i=1;$i<=7;$i++) 
                    @if($sem->results->where('year',$i)->count()>0)
                    <div id="flush-collapseresults{{$i}}" class="accordion-collapse collapse {{$i==1?'show':''}}" data-bs-parent="#accordionFlushExampleC">
                        <div class="accordion-body">
                            <h2 class="text-center  text-capitalize">Results for Year {{$i}}</h2>
                            <ol class="ms-0">
                                <hr>
                                <div class="ms-auto">
                                    <li></li>
                                </div>
                                <hr>
                            </ol>
                        </div>
                    </div>
                    @endif
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
@endsection