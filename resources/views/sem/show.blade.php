@extends('layouts.admin')
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
                <a class="nav-link" aria-current="page" href="#" data-bs-toggle="collapse" data-bs-target="#flush-collapseResults" aria-expanded="false" aria-controls="flush-collapseResults">
                    <button class="btn btn-info">Results</button>
                </a>
            </li>
        </ul>
        <div id="flush-collapsestudents" class="accordion-collapse collapse show" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <div class="accordion accordion-flush" id="accordionFlushExampleA">
                    <ul class="nav ms-auto me-auto">
                        @for($i=1;$i<=7;$i++) @if($sem->students->where('year',$i)->count()>0)
                            <li class="nav-item accordion-item">
                                <a class="nav-link" aria-current="page" href="#" data-bs-toggle="collapse" data-bs-target="#flush-collapsestudents{{$i}}" aria-expanded="false" aria-controls="flush-collapsestudents{{$i}}">
                                    Year {{$i}}
                                </a>
                            </li>
                            @endif
                            @endfor
                    </ul>
                    @for($i=1;$i<=7;$i++) @if($sem->students->where('year',$i)->count()>0)
                        <div id="flush-collapsestudents{{$i}}" class="accordion-collapse collapse {{$i==1?'show':''}}" data-bs-parent="#accordionFlushExampleA">
                            <div class="accordion-body">
                                <h2 class="text-center  text-capitalize">Year {{$i}} Students</h2>
                                <table class="ms-0 table table-responsive">

                                    @foreach($sem->students->where('year',$i) as $student)
                                    <div class="ms-auto">
                                        <tr>
                                            <td><a href="{{route('students.show',$student->student->id)}}" style='text-decoration:none; color:black;' type="button">{{$student->student->student_name}}</a></li>
                                            </td>
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
                        @for($i=1;$i<=7;$i++) @if($sem->units->where('year',$i)->count()>0)
                            <li class="nav-item accordion-item">
                                <a class="nav-link" aria-current="page" href="#" data-bs-toggle="collapse" data-bs-target="#flush-collapseunits{{$i}}" aria-expanded="false" aria-controls="flush-collapseunits{{$i}}">
                                    Year {{$i}}
                                </a>
                            </li>
                            @endif
                            @endfor
                    </ul>
                    @for($i=1;$i<=7;$i++) @if($sem->units->where('year',$i)->count()>0)
                        <div id="flush-collapseunits{{$i}}" class="accordion-collapse collapse {{$i==1?'show':''}}" data-bs-parent="#accordionFlushExampleB">
                            <div class="accordion-body">
                                <h2 class="text-center  text-capitalize">Units for Year {{$i}}</h2>
                                <table class=" table table-responsive">
                                    <hr>
                                    @foreach($sem->units->where('year',$i) as $unit)
                                    <tr>
                                        <td>{{$unit->unit->unit_code}} {{$unit->unit->unit_title}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="true">
                                                    Actions
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <button type="button" class="dropdown-item text-info" data-bs-toggle="modal" data-bs-target="#units{{$unit->unit->id}}">
                                                            Upload Results
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button type="button" class="dropdown-item text-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$sem->id}}">
                                                            Update
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button type="button" class="dropdown-item  text-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$sem->id}}">
                                                            Delete
                                                        </button>
                                                    </li>
                                                </ul>
                                                <div>
                                                    <div class="modal fade" id="units{{$unit->unit->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Upload Exams</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="{{ route('exams.store', ['unit_id'=>$unit->unit->id,'sem_id'=>$sem->id]) }}" method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        <p>Upload Excel sheet containing exam results in this unit. Remember to format columns in the order <b>"student_reg_no | student_name |attempt | CAT_and_Assignment_score | Exam_score"</b> without empty column or headers.</p>

                                                                        <input type="text" class="form-control" value="{{$unit->unit->unit_code}}" disabled>
                                                                        <div class="form-group m-1">
                                                                            <input type="file" name="file" accept=".xls,.xlsx" id="file" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Upload</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <hr>
                                </table>
                            </div>
                        </div>
                        @endif
                        @endfor
                </div>
            </div>
        </div>
        <div id="flush-collapseResults" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <div class="accordion accordion-flush" id="accordionFlushExampleC">
                    <ul class="nav ms-auto me-auto">
                        @for($i=1;$i<=7;$i++) @if($sem->units->where('year',$i)->count()>0)
                            <li class="nav-item accordion-item">
                                <a class="nav-link" aria-current="page" href="#" data-bs-toggle="collapse" data-bs-target="#flush-collapseResults{{$i}}" aria-expanded="false" aria-controls="flush-collapseResults{{$i}}">
                                    Year {{$i}}
                                </a>
                            </li>
                            @endif
                            @endfor
                    </ul>
                    @for($i=1;$i<=7;$i++) @if($sem->units->where('year',$i)->count()>0)
                        <div id="flush-collapseResults{{$i}}" class="accordion-collapse collapse {{$i==1?'show':''}}" data-bs-parent="#accordionFlushExampleC">
                            <div class="accordion-body">
                                <h2 class="text-center  text-capitalize">Results for Year {{$i}}</h2>
                                <div class="d-flex justify-content-between">
                                    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search by Name or Reg. No..." class="m-2 form-control w-50">
                                    <a href="/SenateDoc/{{$i}}/{{$sem->id}}"><button type="button" class="btn btn-secondary"><i class="fa fa-print"></i>Senate Doc</button></a>
                                </div>
                                <script>
                                    function myFunction() {
                                        // Declare variables
                                        var input, filter, table, tr, td, i, txtValue;
                                        input = document.getElementById("myInput");
                                        filter = input.value.toUpperCase();
                                        table = document.getElementById("myTable");
                                        tr = table.getElementsByTagName("tr");

                                        // Loop through all table rows, and hide those who don't match the search query
                                        for (i = 0; i < tr.length; i++) {
                                            td = tr[i].getElementsByTagName("td")[1];
                                            if (td) {
                                                txtValue = td.textContent || td.innerText;
                                                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                                    tr[i].style.display = "";
                                                } else {
                                                    tr[i].style.display = "none";
                                                }
                                            }
                                        }
                                    }
                                </script>
                                <table class="table table-responsive table-striped-columns" id="myTable">
                                    <thead>
                                        <?php $count = 0;
                                        $res = false; ?>
                                        <tr>
                                            <th>#</th>
                                            <th>Student</th>
                                            @foreach($uns as $unit)
                                            @if($unit->unit->exams->count()!=null)
                                            <?php $count += 1;
                                            $res = true ?>
                                            <th>{{$unit->unit->unit_code}}</th>
                                            @endif
                                            @endforeach
                                            <th>Total</th>
                                            <th>Average</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($res==true)
                                        @foreach($semStudents as $r=>$s)
                                        <?php $total = 0;
                                        $status = false; ?>
                                        <tr>
                                            <td>{{$r+1}}</td>
                                            <td><a href="{{route('students.show',$s->student->id)}}" style='text-decoration:none; color:black;'>{{$s->student->student_name}} <br> {{$s->student->reg_no}}</a></td>

                                            @foreach($uns as $k=>$unit)
                                            @foreach(($unit->unit->exams->where('student_id',$s->id)) as $ex)
                                            @if(($ex->CAT!=null) && ($ex->Exam!=null))
                                            <?php $total += ($ex->CAT) + ($ex->Exam); ?>
                                            <td>{{($ex->CAT)+($ex->Exam)}}</td>
                                            @else
                                            <?php $status = true; ?>
                                            <td class="{{($ex->CAT==null && $ex->Exam==null)?'bg-danger':(($ex->CAT==null)?'bg-secondary':'bg-warning')}}">INCOMPLETE</td>
                                            @endif

                                            @endforeach
                                            @endforeach
                                            @if($status == false && $count>0 && $total>0)
                                            <td>{{$total}}</td>

                                            <td>{{floor($total/$count)}}</td>

                                            @else
                                            <td class="bg-danger text-light">Missing Marks</td>
                                            <td>---</td>
                                            @endif
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>

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