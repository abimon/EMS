@extends('layouts.tables')
@section('content')
<div class="container-fluid">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="modal-footer">
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
                <th></th>
                <th></th>
                <th></th>
                <th colspan="4" class="text-center">CATs</th>
                <th colspan="4" class="text-center">ASSIGNMENTS</th>
                <th></th>
                <th colspan="6" class="text-center">EXAM QUIZES</th>
                <th></th>
            </tr>
            <tr>
                <th>#</th>
                <th>Student</th>
                <th>Attempt</th>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>Total</th>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>Total</th>
                <th>CAT+ASN</th>
                <th>Q1</th>
                <th>Q2</th>
                <th>Q3</th>
                <th>Q4</th>
                <th>Q5</th>
                <th>Total</th>
                <th>Unit Marks</th>
                <th>Remark</th>
            </tr>
        </thead>
        <tbody>
            <tr>
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
            </tr>
            @foreach($items as $key=>$item)
            <tr>
                
                <td>{{$key+1}}</td>
                <td>{{$item->reg_no}} <br> <small>{{$item->name}}</small></td>
                <td>{{$item->attempt}}</td>
                <td class="{{$item->CAT1==''?'bg-dark':''}}">{{$item->CAT1}}</td>
                <td class="{{$item->CAT2==''?'bg-dark':''}}">{{$item->CAT2}}</td>
                <td class="{{$item->CAT3==''?'bg-dark':''}}">{{$item->CAT3}}</td>
                <td>{{$item->CAT_t}}</td>
                <td class="{{$item->ASN1==''?'bg-dark':''}}">{{$item->ASN1}}</td>
                <td class="{{$item->ASN2==''?'bg-dark':''}}">{{$item->ASN2}}</td>
                <td class="{{$item->ASN3==''?'bg-dark':''}}">{{$item->ASN3}}</td>
                <td>{{$item->ASN_t}}</td>
                <td>{{($item->CAT_t)+($item->ASN_t)}}</td>
                <td class="{{$item->Q1==''?'bg-dark':''}}">{{$item->Q1}}</td>
                <td class="{{$item->Q2==''?'bg-dark':''}}">{{$item->Q2}}</td>
                <td class="{{$item->Q3==''?'bg-dark':''}}">{{$item->Q3}}</td>
                <td class="{{$item->Q4==''?'bg-dark':''}}">{{$item->Q4}}</td>
                <td class="{{$item->Q5==''?'bg-dark':''}}">{{$item->Q5}}</td>
                <td>{{$item->Exam_t}}</td>
                <td>{{$item->marks}}</td>
                <?php $g = $item->marks;?>
                <td>@if($g>=70)
                    A
                    @elseif($g>=60)
                    B
                    @elseif($g>=50)
                    C
                    @elseif($g>=40)
                    D
                    @elseif($g>0)
                    E
                    @else
                    <i class="text-danger">Missing</i>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection