@extends('layouts.tables')
@section('content')
<div class="container-fluid">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="d-flex justify-content-between">
        <div>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#Passes">{{$pass->count()}} Passes</button>

            <!-- Modal -->
            <div class="modal fade" id="Passes" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="PassesLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="PassesLabel">Passes</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="text-center">The following <b>{{$pass->count()}}</b> student(s) met the requirements of the senate for the unit <b>{{$unit->unit_title}}({{$unit->unit_code}})</b></p>
                            <hr>
                            <ol>
                                @foreach($pass as $pas)
                                @foreach($items as $item)
                                @if($pas->exam_id == $item->id)
                                <li>{{$item->reg_no}} {{$item->name}}</li>
                                @endif
                                @endforeach
                                @endforeach
                            </ol>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <!-- <button type="button" class="btn btn-primary">Understood</button> -->
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#Specials">{{$specs->count()}} Specials</button>

            <!-- Modal -->
            <div class="modal fade" id="Specials" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="PassesLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="SpecialsLabel">Specials</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="text-center">The following <b>{{$specs->count()}}</b> student(s) have special sitting for the unit <b>{{$unit->unit_title}}({{$unit->unit_code}})</b></p>
                            <hr>
                            <ol>
                                @foreach($specs as $pas)
                                @foreach($items as $item)
                                @if($pas->exam_id == $item->id)
                                <li>{{$item->reg_no}} {{$item->name}}</li>
                                @endif
                                @endforeach
                                @endforeach
                            </ol>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <!-- <button type="button" class="btn btn-primary">Understood</button> -->
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#Supps">{{$sups->count()}} Supps</button>

            <!-- Modal -->
            <div class="modal fade" id="Supps" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="SuppsLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="SuppsLabel">Supplementaries</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="text-center">The following <b>{{$sups->count()}}</b> student(s) did not meet the senate requirements for the unit <b>{{$unit->unit_title}}({{$unit->unit_code}})</b></p>
                            <hr>
                            <ol>
                                @foreach($sups as $pas)
                                @foreach($items as $item)
                                @if($pas->exam_id == $item->id)
                                <li>{{$item->reg_no}} {{$item->name}}</li>
                                @endif
                                @endforeach
                                @endforeach
                            </ol>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search by Name or Reg. No..." class="m-2 form-control w-50">
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
            <tr>
                <th>#</th>
                <th>Student</th>
                <th>ASSESSMENT</th>
                <th>EXAM</th>
                <th>TOTAL</th>
                <th>Remark</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $key=>$item)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$item->reg_no}} <br> <small>{{$item->student_name}}</small></td>
                <td>{{$item->CAT}}</td>
                <td>{{$item->Exam}}</td>
                    @if(($item->Exam!=null)&&($item->CAT!=null))
                    <td>{{($item->Exam)+($item->CAT)}}</td>
                    @else
                    <td class="{{(($item->CAT==null)&&($item->Exam==null))?'bg-danger text-light':'bg-warning text-dark'}}">INCOMPLETE</td>
                    @endif
                <?php $g = $item->marks; ?>
                <td>@if($g>=70)
                    A
                    @elseif($g>=60)
                    B
                    @elseif($g>=50)
                    C
                    @elseif($g>=40)
                    D
                    @elseif($g>0)
                        @if($item->CAT==null)
                        <i class="text-danger">CAT marks missing</i><br>
                        @endif
                        @if($item->Exam==null)
                        <i class="text-danger">EXAM marks missing</i><br>
                        @endif
                        E
                    @else
                        @if($item->CAT==null)
                        <i class="text-danger">CAT marks missing</i><br>
                        @endif
                        @if($item->Exam==null)
                        <i class="text-danger">EXAM marks missing</i><br>
                        @endif
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection