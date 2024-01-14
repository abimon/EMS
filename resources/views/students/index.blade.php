@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search Reg. No..." class="m-2 form-control w-50">
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
                td = tr[i].getElementsByTagName("td")[2];
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
    <table class="table table-scroll table-info table-striped table-hover" id="myTable">
        <thead>
            <tr>
                <th>#</th>
                <th scope="col">Name</th>
                <th scope="col">Reg. No.</th>
                <th scope="col">Intake</th>
                <th scope="col">ID</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $key=>$user)

            <tr>
                <td>{{$key+1}}</td>
                <td class="text-uppercase"><a href="{{route('students.show',$user->id)}}" style='text-decoration:none; color:black;' type="button">{{$user->student_name}}</a></td>
                <td class="text-uppercase">{{$user->reg_no}}</td>
                <td>{{$user->intake}}</td>
                <td>{{$user->identifier}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection