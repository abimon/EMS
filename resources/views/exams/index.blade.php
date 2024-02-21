@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="d-flex justify-content-between">
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
            @foreach($exams as $key=>$exam)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$exam->student->reg_no}} {{$exam->student->student_name}}</td>
                <td>{{$exam->CAT}}</td>
                <td>{{$exam->Exam}}</td>
                @if(($exam->Exam != null)&&($exam->CAT != null))
                <td>{{($exam->CAT)+($exam->Exam)}}</td>
                <td>
                    <?php $g=($exam->Exam)+($exam->CAT);?>
                    @if($g>=70)
                    A
                    @elseif($g>=60)
                    B
                    @elseif($g>=50)
                    C
                    @elseif($g>=40)
                    D
                    @elseif($g>0)
                    @if($exam->CAT==null)
                    <i class="text-danger">CAT marks missing</i><br>
                    @endif
                    @if($exam->Exam==null)
                    <i class="text-danger">EXAM marks missing</i><br>
                    @endif
                    E
                    @else
                    @if($exam->CAT==null)
                    <i class="text-danger">CAT marks missing</i><br>
                    @endif
                    @if($exam->Exam==null)
                    <i class="text-danger">EXAM marks missing</i><br>
                    @endif
                    @endif
                </td>
                @else
                <td class="{{(($exam->Exam == null)&&($exam->CAT == null))?'bg-danger':'bg-warning'}}">Issue!</td>
                <td>
                    @if($exam->CAT==null)
                    <i class="text-danger">CAT marks missing</i><br>
                    @endif
                    @if($exam->Exam==null)
                    <i class="text-danger">EXAM marks missing</i><br>
                    @endif
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection