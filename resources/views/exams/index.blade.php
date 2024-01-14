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
                            <!-- <button type="button" class="btn btn-primary">Understood</button> -->
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
            <!-- <tr>
                <th></th>
                <th></th>
                <th></th>
                <th colspan="4" class="text-center">CATs</th>
                <th colspan="4" class="text-center">ASSIGNMENTS</th>
                <th></th>
                <th colspan="6" class="text-center">EXAM QUIZES</th>
                <th></th>
                <th></th>
            </tr> -->
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
            <!-- <tr>
                <th></th>
                <th></th>
                <th></th>
                <th>x/{{$totals->CAT1}}</th>
                <th>x/{{$totals->CAT2}}</th>
                <th>x/{{$totals->CAT3}}</th>
                <th>x/{{$totals->CAT_total}}</th>
                <th>x/{{$totals->ASN1}}</th>
                <th>x/{{$totals->ASN2}}</th>
                <th>x/{{$totals->ASN3}}</th>
                <th>x/{{$totals->ASN_total}}</th>
                <th>x/{{($totals->ASN_total)+($totals->CAT_total)}}</th>
                <th>x/{{$totals->Q1}}</th>
                <th>x/{{$totals->Q2}}</th>
                <th>x/{{$totals->Q3}}</th>
                <th>x/{{$totals->Q4}}</th>
                <th>x/{{$totals->Q5}}</th>
                <th>x/{{$totals->exam_total}}</th>
                <th>x/{{($totals->exam_total)+($totals->ASN_total)+($totals->CAT_total)}}</th>
                <th></th>
            </tr> -->
            @foreach($items as $key=>$item)
            <tr>

                <td>{{$key+1}}</td>
                <td>{{$item->reg_no}} <br> <small>{{$item->student_name}}</small></td>
                <!-- <td>{{$item->attempt}}</td> -->
                <!-- <td class="{{$item->CAT1==''?'bg-dark':''}}">{{$item->CAT1}}</td>
                <td class="{{$item->CAT2==''?'bg-dark':''}}">{{$item->CAT2}}</td>
                <td class="{{$item->CAT3==''?'bg-dark':''}}">{{$item->CAT3}}</td> -->
                <!-- <td>{{$item->CAT_t}}</td> -->
                <!-- <td class="{{$item->ASN1==''?'bg-dark':''}}">{{$item->ASN1}}</td>
                <td class="{{$item->ASN2==''?'bg-dark':''}}">{{$item->ASN2}}</td>
                <td class="{{$item->ASN3==''?'bg-dark':''}}">{{$item->ASN3}}</td> -->
                <!-- <td>{{$item->ASN_t}}</td> -->
                <td>{{($item->CAT_t)+($item->ASN_t)}}</td>
                <!-- <td class="{{$item->Q1==''?'bg-dark':''}}">{{$item->Q1}}</td>
                <td class="{{$item->Q2==''?'bg-dark':''}}">{{$item->Q2}}</td>
                <td class="{{$item->Q3==''?'bg-dark':''}}">{{$item->Q3}}</td>
                <td class="{{$item->Q4==''?'bg-dark':''}}">{{$item->Q4}}</td>
                <td class="{{$item->Q5==''?'bg-dark':''}}">{{$item->Q5}}</td> -->
                <td>{{$item->Exam_t}}</td>
                <td>{{$item->marks}}</td>
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
                    @if(($item->CAT1==null)||($item->CAT2==null)||($item->CAT3==null))
                    <i class="text-danger">CAT marks missing</i><br>
                    @endif
                    @if(($item->ASN1==null)||($item->ASN2==null)||($item->ASN3==null))
                    <i class="text-danger">Assignment marks missing</i><br>
                    @endif
                    @if(($item->Exam_t==null)||($item->Exam_t==0))
                    <i class="text-danger">EXAM marks missing</i><br>
                    @endif
                    E

                    @else
                    @if(($item->CAT1==null)||($item->CAT2==null)||($item->CAT3==null))
                    <i class="text-danger">CAT marks missing</i><br>
                    @endif
                    @if(($item->ASN1==null)||($item->ASN2==null)||($item->ASN3==null))
                    <i class="text-danger">Assignment marks missing</i><br>
                    @endif
                    @if(($item->Exam_t==null)||($item->Exam_t==0))
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