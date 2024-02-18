@extends('layouts.admin')

@section('content')
<div class="container">
    <div>
        <h2 class='text-center'>Semesters</h2>
    </div>
    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addsem">+ Add Sem</button>

        <!-- Modal -->
        <div class="modal fade" id="addsem" tabindex="-1" aria-labelledby="addsemLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addsemLabel">Add Sem</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('sem.store')}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <?php $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                            $semis = ['First', 'Second', 'Third'];
                            ?>
                            <select name="sem" id="" class="form-select" required>
                                <option value="" disabled>To</option>
                                @foreach($semis as $semi)
                                <option value="{{$semi}}">{{$semi}}</option>
                                @endforeach
                            </select>
                            <div class="d-flex justify-content-between">
                                <select name="from" id="" class="form-select" required>
                                    <option value="" disabled>From</option>
                                    @foreach($months as $month)
                                    <option value="{{$month}}">{{$month}}</option>
                                    @endforeach
                                </select>
                                <select name="to" id="" class="form-select" required>
                                    <option value="" disabled>To</option>
                                    @foreach($months as $month)
                                    <option value="{{$month}}">{{$month}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <table class="table table-responsive">
        <thead>
            <tr class="text-uppercase">
                <th>#</th>
                <th>Sem</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($sems as $key=>$sem)
            <tr>
                <td>{{$key+1}}</td>
                <td><a href="{{route('sem.show',$sem->id)}}">{{$sem->year}} {{$sem->sem}} Semester ({{$sem->timelines}})</a></td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="true">
                            Actions
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <button type="button" class="dropdown-item btn btn-info" data-bs-toggle="modal" data-bs-target="#units{{$sem->id}}">
                                    Upload Units
                                </button>
                            </li>
                            <li>
                                <button type="button" class="dropdown-item btn btn-primary" data-bs-toggle="modal" data-bs-target="#students{{$sem->id}}">
                                    Upload Students
                                </button>
                            </li>
                            <li>
                                <button type="button" class="dropdown-item btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$sem->id}}">
                                    Delete
                                </button>
                            </li>
                            <li>
                                <form action="{{route('sem.update',$sem->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="dropdown-item btn btn-danger">
                                        @if($sem->status==1)
                                        Close Reporting
                                        @else
                                        Open Reporting
                                        @endif
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="modal fade" id="staticBackdrop{{$sem->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$sem->sem}} {{$sem->timelinse}} {{$sem->year}}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{route('sem.destroy', $sem->id)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <div class="modal-body">
                                        Are you sure you want to delete this semester?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                        <button type="submit" class="btn btn-danger">Sure</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="students{{$sem->id}}" tabindex="-1" aria-labelledby="addstuLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="addstuLabel">Upload Students</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{route('semStudents.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <p>
                                            Upload Excel sheet containing students in this course for this semester. Remember to format columns in the order <b>"registration_no|year|identifier(if any)"</b> without empty column or headers.
                                        </p>
                                        <input type="hidden" name="sem_id" value="{{$sem->id}}">
                                        <input type="file" name="students" placeholder="Students" id="" class="form-control mb-2">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="units{{$sem->id}}" tabindex="-1" aria-labelledby="addcourseLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="addcourseLabel">Add Units</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{route('semUnits.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <p>
                                            Upload Excel sheet containing units in this course for this semester. Remember to format columns in the order <b>"unit code | year group"</b> without empty column or headers.
                                        </p>
                                        <label for="">Units</label>
                                        <input type="hidden" name='sem_id' value="{{$sem->id}}">
                                        <input type="file" name="units" placeholder="units" id="" class="form-control mb-2">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection