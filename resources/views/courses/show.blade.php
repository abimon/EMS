@extends('layouts.admin')
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
            @for($i=1;$i<=7;$i++) @if($course->units->where('yearG',$i)->count()>0)
                <li class="nav-item accordion-item">
                    <a class="nav-link" aria-current="page" href="#" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$i}}" aria-expanded="false" aria-controls="flush-collapse{{$i}}">
                        Year {{$i}}
                    </a>
                </li>
                @endif
                @endfor
                <li class="nav-item">
                    <button type="button" class="btn btn-primary m-1" data-bs-toggle="modal" data-bs-target="#addUnit">+ Add Units</button>
                </li>
                <!-- Modal -->
                <div class="modal fade" id="addUnit" tabindex="-1" aria-labelledby="addUnitLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="addcourseLabel">Add Units</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{route('unit.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <p>
                                        Upload Excel sheet containing units in this course. Remember to format columns in the order <b>"unit code | unit title | year| semester |compulsory or optional| course or university unit "</b> without empty column or headers.
                                    </p>
                                    <label for="">Units</label>
                                    <input type="hidden" name='id' value="{{$course->id}}">
                                    <input type="file" name="file" placeholder="units" id="" class="form-control mb-2">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </ul>
        @for($i=1;$i<=7;$i++) @if($course->units->where('yearG',$i)->count()>0)
            @for($k=1;$k<=3;$k++) @if($course->units->where('sem',$k)->count()>0)
                <div id="flush-collapse{{$i}}" class="accordion-collapse collapse {{$i==1?'show':''}}" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <h2>Sem {{$k}}</h2>
                        <ol class="ms-0">
                            <hr>
                            @foreach($course->units->where('yearG',$i)->where('sem',$k) as $unit)
                            <div >
                                <li class="d-flex justify-content-between"><a href="#" data-bs-toggle="modal" data-bs-target="#editUnit{{$unit->id}}" style="text-decoration: none;">{{$unit->unit_code}} {{$unit->unit_title}}</a> <i>({{$unit->need}})</i></li>
                                <!-- Modal -->
                                <div class="modal fade" id="editUnit{{$unit->id}}" tabindex="-1" aria-labelledby="editUnit{{$unit->id}}Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="addcourseLabel">{{$unit->unit_code}} {{$unit->unit_title}}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{route('unit.update',$unit->id)}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-floating">
                                                        <input type="text" name="unit_title" value="{{$unit->unit_title}}" id="" class="form-control mb-2">
                                                        <label for="">Unit Title</label>
                                                    </div>
                                                    <div class="form-floating">
                                                        <input type="text" name="unit_code" value="{{$unit->unit_code}}" id="" class="form-control mb-2">
                                                        <label for="">Unit Code</label>
                                                    </div>
                                                    <div class="form-floating">
                                                        <input type="text" name="yearG" value="{{$unit->yearG}}" id="" class="form-control mb-2">
                                                        <label for="">Unit Study Year</label>
                                                    </div>
                                                    <div class="form-floating">
                                                        <input type="text" name="sem" value="{{$unit->sem}}" id="" class="form-control mb-2">
                                                        <label for="">Unit Study Sem</label>
                                                    </div>
                                                    <div class="form-floating">
                                                        <input type="text" name="category" value="{{$unit->category}}" id="" class="form-control mb-2">
                                                        <label for="">Unit Study Provider</label>
                                                    </div>
                                                    <div class="form-floating">
                                                        <input type="text" name="need" value="{{$unit->need}}" id="" class="form-control mb-2">
                                                        <label for="">Unit Necessity</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <a href="{{route('unit.destroy',$unit->id)}}"><button type="button" class="btn btn-danger">Delete</button></a>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @endforeach
                        </ol>
                    </div>
                </div>
                @endif
                @endfor
                @endif
                @endfor

    </div>
</div>
@endsection