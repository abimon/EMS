@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row d-flex justify-content-between">
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search Reg. No..." class="mb-2 form-control w-50">
        <button type="button" class="mb-2 btn btn-primary col-md-3" data-bs-toggle="modal" data-bs-target="#addstu"><i class="fa fa-upload"></i> Students</button>
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


    <!-- Modal -->
    <div class="modal fade" id="addstu" tabindex="-1" aria-labelledby="addstuLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addstuLabel">Upload Students</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('students.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <p>
                            Upload Excel sheet containing students in this course. Remember to format columns in the order <b>"registration_no|name|year_of_intake|identifier(if any)"</b> without empty column or headers.
                        </p>
                        <select name="course_id" id="" class="form-select" required>
                            <option value="">Select Course</option>
                            @foreach($courses as $course)
                            <option value="{{$course->id}}">{{$course->course_name}}</option>
                            @endforeach
                        </select>
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